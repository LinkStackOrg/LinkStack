# Apache runtime-log regression test

Related report: https://github.com/LinkStackOrg/linkstack-docker/issues/168
Related architecture discussion: https://github.com/LinkStackOrg/LinkStack/issues/935

The root `.htaccess` already blocks files ending in `.log`. The additional
log-directory rule also blocks rotated logs such as `laravel.log.1`, backup
suffixes, nested files and application routes under the private log paths.
It runs before front-controller routing and works with subdirectory deployments
because Apache matches per-directory rewrite rules relative to that directory.

This is targeted Apache hardening, not a migration to a public-only document
root. Nginx, Caddy and IIS do not enforce `.htaccess`; configure equivalent
protection or a public-only document root on those servers. Apache requires
`mod_rewrite` and permission to process the project's `.htaccess`.

## Running the test

Requires Python 3, Docker and an Apache/PHP test image with `/htdocs`, internal
HTTP/HTTPS listeners, curl, and enabled `.htaccess` processing. The image must
not already deny log directories: image-side protection would hide regressions
in the project rule. The following known Docker-repository revision provides
that baseline (no application release needed for the synthetic fixtures):

```sh
git clone https://github.com/LinkStackOrg/linkstack-docker.git /path/to/docker-test
git -C /path/to/docker-test checkout 50b92be8711b5ed03ea9a675d9cde3409b0c80a8
docker build -t linkstack-apache-baseline /path/to/docker-test
# Run from the LinkStack application checkout:
python3 tests/runtime_logs.py linkstack-apache-baseline
```

This tests the actual root `.htaccess` with disposable files, not production
logs. A negative control removes only the new rewrite rule and requires the
rotated log to be retrievable, rejecting images whose own protection would mask
a broken project rule. The test asserts HTTP/HTTPS 403 responses without marker disclosure, working PHP,
public assets and public storage, and continued log writing as the unprivileged
container user. URL cases include query strings, encoded characters, repeated
slashes and dot segments. No ports are published; the containers have no
external network. Test containers are removed on completion or test failure.
The test image's self-signed TLS certificate is deliberately accepted only for
requests inside the isolated test container.

Before deployment, back up and update the existing root `.htaccess`, including
in persistent application volumes, and verify the effective server configuration.
This test does not exercise a complete Laravel installation or the updater.
