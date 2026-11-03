---
mode: testing
url: http://localhost:8190/login
max_steps: 40
---

# Add a link and see it on the public page

## Log in
Open http://localhost:8190/login.
Enter "alex@example.com" as the email and "LinkStack-Test-2026" as the password, and click "Sign In".
Verify the dashboard is shown with the greeting "Hi, @alexmorgan".

## Add a link
Click "Add Link" in the sidebar.
Select "GitHub" in the "Select a predefined site" list.
Enter "My GitHub" as the custom title and "https://github.com/alexmorgan" as the URL.
Click "Save".

## Check the link
Verify the "Links" page is shown and lists "My GitHub", waiting for it to update if needed.
Open http://localhost:8190/@alexmorgan.
Verify the public page shows the name "Alex Morgan" and a "My GitHub" button.
