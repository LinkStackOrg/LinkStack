#!/usr/bin/env python3
"""Test the project .htaccess log protection with an Apache/PHP image.

The image must use /htdocs, expose internal HTTP/HTTPS, include curl, and
permit .htaccess overrides. It must NOT already deny log directories, or it
would mask regressions in this project. See tests/runtime_logs.md.

Usage: python3 tests/runtime_logs.py IMAGE
Requires Python 3 and Docker. Uses disposable fixtures, no production data,
no published ports, and no external container network access.
"""
import pathlib
import subprocess
import sys
import tempfile
import time
import uuid


def docker(*args, check=True):
    return subprocess.run(["docker", *args], check=check, text=True,
                          stdout=subprocess.PIPE, stderr=subprocess.PIPE)


def request(name, scheme, path):
    result = docker("exec", name, "curl", "--silent", "--show-error",
                    "--insecure", "--max-time", "5", "--path-as-is",
                    "--write-out", "\n%{http_code}", scheme + "://127.0.0.1" + path,
                    check=False)
    if result.returncode:
        raise RuntimeError(result.stderr.strip())
    body, status = result.stdout.rsplit("\n", 1)
    return int(status), body


def run(image):
    failures = []
    checks = 0
    marker = "PRIVATE-LOG-" + uuid.uuid4().hex
    project_htaccess = (pathlib.Path(__file__).resolve().parents[1] / ".htaccess").read_text()
    rule = "    RewriteRule ^(?:assets/)?storage/logs(?:/|$) - [F,L,NC]\n"
    if project_htaccess.count(rule) != 1:
        raise RuntimeError("Expected exactly one log-directory rule in project .htaccess")
    scenarios = {
        "negative-control": project_htaccess.replace(rule, ""),
        "project-htaccess": project_htaccess,
    }
    for scenario, htaccess in scenarios.items():
        with tempfile.TemporaryDirectory(prefix="linkstack-log-test-") as tmp:
            root = pathlib.Path(tmp)
            # Apache runs unprivileged and writes its PID into the fixture.
            root.chmod(0o777)
            fixtures = {
                "version.json": '"test-fixture"\n',
                "index.php": '<?php echo "PHP-CONTROL";',
                "assets/control.txt": "PUBLIC-CONTROL",
                "storage/app/public/control.txt": "STORAGE-CONTROL",
                "storage/logs-public/control.txt": "PREFIX-CONTROL",
                "storage/logs/laravel.log": marker,
                "storage/logs/laravel-2026-01-01.log": marker,
                "storage/logs/laravel.log.1": marker,
                "storage/logs/nested/trace.txt": marker,
                "assets/storage/logs/laravel.log": marker,
                "storage/logs/laravel.log.bak": marker,
                "assets/storage/logs/laravel.log.1": marker,
                "assets/storage/logs/nested/trace.txt": marker,
            }
            if htaccess is not None:
                fixtures[".htaccess"] = htaccess
            for relative, content in fixtures.items():
                path = root / relative
                path.parent.mkdir(parents=True, exist_ok=True)
                path.write_text(content)
                path.chmod(0o666 if relative == "storage/logs/laravel.log" else 0o644)
            name = "linkstack-log-test-" + uuid.uuid4().hex[:12]
            try:
                docker("run", "--detach", "--name", name, "--network", "none",
                       "--no-healthcheck", "--mount", "type=bind,src=" + tmp + ",dst=/htdocs",
                       image)
                for attempt in range(50):
                    try:
                        status, body = request(name, "http", "/assets/control.txt")
                        if status == 200 and body == "PUBLIC-CONTROL":
                            break
                    except RuntimeError:
                        pass
                    time.sleep(0.1)
                else:
                    raise RuntimeError("Apache not ready: " + docker("logs", name).stderr)
                docker("exec", "--env", "SERVER_ADMIN=test@example.invalid",
                       "--env", "HTTP_SERVER_NAME=localhost", "--env", "LOG_LEVEL=warn",
                       name, "httpd", "-t")
                for scheme in ("http", "https"):
                    for path, expected in (("/assets/control.txt", "PUBLIC-CONTROL"),
                                           ("/storage/app/public/control.txt", "STORAGE-CONTROL"),
                                           ("/storage/logs-public/control.txt", "PREFIX-CONTROL"),
                                           ("/index.php", "PHP-CONTROL")):
                        status, body = request(name, scheme, path)
                        checks += 1
                        if status != 200 or body != expected:
                            failures.append(f"{scenario} {scheme} {path}: public control failed ({status})")
                    if scenario == "negative-control":
                        status, body = request(name, scheme, "/storage/logs/laravel.log.1")
                        checks += 1
                        if status != 200 or marker not in body:
                            failures.append(f"{scheme}: negative control failed; image-side protection may mask the project rule ({status})")
                        continue
                    for path in (
                        "/storage/logs/laravel.log",
                        "/storage/logs/laravel-2026-01-01.log",
                        "/storage/logs/laravel.log.1",
                        "/storage/logs/nested/trace.txt",
                        "/storage/logs/",
                        "/storage/logs",
                        "/assets/storage/logs",
                        "/storage/logs/nonexistent-route",
                        "/assets/storage/logs/laravel.log",
                        "/storage/logs/laravel.log?download=1",
                        "/storage/%6cogs/laravel.log",
                        "/storage//logs/laravel.log",
                        "/storage/logs/../logs/laravel.log",
                        "/storage/logs/laravel.log.bak",
                        "/assets/storage/logs/laravel.log.1",
                        "/assets/storage/logs/nested/trace.txt",
                    ):
                        status, body = request(name, scheme, path)
                        checks += 1
                        if status != 403 or marker in body:
                            failures.append(f"{scenario} {scheme} {path}: expected 403, got {status}; marker exposed={marker in body}")
                docker("exec", name, "sh", "-c",
                       "printf '\\nWRITE-CONTROL' >> /htdocs/storage/logs/laravel.log")
                checks += 1
                if "WRITE-CONTROL" not in (root / "storage/logs/laravel.log").read_text():
                    failures.append(scenario + ": runtime log append failed")
            finally:
                docker("rm", "--force", name, check=False)
            print(scenario + ": completed")
    for failure in failures:
        print("FAIL " + failure)
    print(f"{checks} checks; {len(failures)} failures")
    return bool(failures)


if __name__ == "__main__":
    if len(sys.argv) != 2:
        sys.exit("Usage: python3 tests/runtime_logs.py IMAGE")
    sys.exit(run(sys.argv[1]))
