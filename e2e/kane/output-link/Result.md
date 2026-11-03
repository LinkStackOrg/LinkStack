---
test: ../link_test.md
status: passed
started: 2026-10-16T13:49:05.590Z
duration_s: 147
session_id: 4e029abe-7d8b-4b95-b2aa-3b9d4e971c09
---

# Add a link and see it on the public page — Result

## Log in ✓ passed (41s)
md5: 64db8512799a1114587c0c863623e4a0
Open http://localhost:8190/login.
Enter "alex@example.com" as the email and "LinkStack-Test-2026" as the password, and click "Sign In".
Verify the dashboard is shown with the greeting "Hi, @alexmorgan".

## Add a link ✓ passed (44.3s)
md5: 5740061d5e5096a35408547fc2e640f8
Click "Add Link" in the sidebar.
Select "GitHub" in the "Select a predefined site" list.
Enter "My GitHub" as the custom title and "https://github.com/alexmorgan" as the URL.
Click "Save".

## Check the link ✓ passed (57.9s)
md5: 36eb9e4f81565262e0e270562dbbf7c3
Verify the "Links" page is shown and lists "My GitHub", waiting for it to update if needed.
Open http://localhost:8190/@alexmorgan.
Verify the public page shows the name "Alex Morgan" and a "My GitHub" button.
