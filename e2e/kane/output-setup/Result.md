---
test: ../setup_test.md
status: passed
started: 2026-10-16T13:44:28.768Z
duration_s: 236
session_id: a516627a-802d-4a3c-a1b7-e752e31fa098
---

# Install LinkStack with the setup wizard — Result

## Start the setup ✓ passed (3.14s)
md5: 3dccf4458d16236a2543831bfea5177b
Open http://localhost:8190/.
Verify the "Setup LinkStack" page is shown with the text "Welcome to the setup for LinkStack!".
Keep "en" as the language and click "Next".
Verify the "Dependency check" page is shown and click "Next".

## Choose the database ✓ passed (62.3s)
md5: 26015236fb6504dd5a32f300da9d2ad5
Verify the "Select a database type" page is shown.
Keep "SQLite" as the database type and click "Next".
Verify the "Create an admin account." page is shown with "Admin email" and "Admin password" fields, waiting for it to load if needed.

## Create the admin account ✓ passed (56.3s)
md5: 0ea4e931090db40b7be5648806934261
Enter "alex@example.com" as the admin email, "LinkStack-Test-2026" as the admin password, "alexmorgan" as the handle and "Alex Morgan" as the name.
Click "Next".
Verify the "Configure your page" page is shown, waiting for it to load if needed.

## Configure the page ✓ passed (52.2s)
md5: 82e60a72e481dba1b6a89c0afbd66f98
Select "No" for "Enable registration" and "No" for "Enable email verification". Keep the other settings.
Click "Finish setup".
Verify the "Sign In" page is shown, waiting for it to load if needed.

## Log in ✓ passed (55s)
md5: 5d818b9accbd646985beac1bbc3ef45a
Enter "alex@example.com" as the email and "LinkStack-Test-2026" as the password, and click "Sign In".
Verify the dashboard is shown with the greeting "Hi, @alexmorgan" and "Total Links: 0".
