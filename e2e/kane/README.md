# End-to-end (e2e) tests for web

Browser end-to-end tests for LinkStack, authored with [KaneCLI](https://www.testmuai.com/kane-cli/) by TestMu AI. Each test is a plain-English `_test.md` file; KaneCLI runs it in a real Chrome browser and records each step so later runs replay without re-authoring.

| Test | What it covers |
|---|---|
| `setup_test.md` | The first-run setup wizard (language, dependency check, SQLite, admin account, page settings), then signing in and checking the dashboard |
| `link_test.md` | Signing in, adding a GitHub link from the predefined sites, and checking it on the Links page and on the public `@alexmorgan` page |

They complement the PHPUnit suite by going through the whole app in a browser.

## Run the tests

The tests expect a new LinkStack install at `http://localhost:8190`, for example with the official Docker image:

```bash
docker run -d --name linkstack-e2e -p 8190:80 \
  -e SERVER_ADMIN=admin@example.com -e HTTP_SERVER_NAME=localhost:8190 \
  linkstackorg/linkstack:latest
```

Run `setup_test.md` first: it installs LinkStack and creates the admin account (`alex@example.com` / `LinkStack-Test-2026`, handle `alexmorgan`) that `link_test.md` signs in with. To run them again, recreate the container.

### With KaneCLI

```bash
npm install -g @testmuai/kane-cli
kane-cli login
kane-cli testmd run e2e/kane/setup_test.md --agent
kane-cli testmd run e2e/kane/link_test.md --agent
```

### With the exported Playwright code

Each test also has an exported Playwright (JavaScript) version under `output-<test>/playwright-javascript-code/`:

```bash
cd e2e/kane/output-setup/playwright-javascript-code
npm install
npx playwright install chromium
node test.js
```

Copy `.env.example` to `.env` and fill in your TestMu AI (LambdaTest) credentials first.

## Editing a test

Edit the step text in the `_test.md` file and run it again with `kane-cli testmd run`. Changed steps (and the steps after them) are re-recorded; unchanged steps replay from `output-<test>/`.
