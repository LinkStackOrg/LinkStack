---
mode: testing
url: http://localhost:8190/
max_steps: 40
---

# Install LinkStack with the setup wizard

## Start the setup
Open http://localhost:8190/.
Verify the "Setup LinkStack" page is shown with the text "Welcome to the setup for LinkStack!".
Keep "en" as the language and click "Next".
Verify the "Dependency check" page is shown and click "Next".

## Choose the database
Verify the "Select a database type" page is shown.
Keep "SQLite" as the database type and click "Next".
Verify the "Create an admin account." page is shown with "Admin email" and "Admin password" fields, waiting for it to load if needed.

## Create the admin account
Enter "alex@example.com" as the admin email, "LinkStack-Test-2026" as the admin password, "alexmorgan" as the handle and "Alex Morgan" as the name.
Click "Next".
Verify the "Configure your page" page is shown, waiting for it to load if needed.

## Configure the page
Select "No" for "Enable registration" and "No" for "Enable email verification". Keep the other settings.
Click "Finish setup".
Verify the "Sign In" page is shown, waiting for it to load if needed.

## Log in
Enter "alex@example.com" as the email and "LinkStack-Test-2026" as the password, and click "Sign In".
Verify the dashboard is shown with the greeting "Hi, @alexmorgan" and "Total Links: 0".
