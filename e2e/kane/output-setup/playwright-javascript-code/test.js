import testmu, { resolveVar, setVar } from '@testmuai/playwright-bindings';
import { expect } from '@playwright/test';

testmu.configure({
  "build": "dbd4f76d-2364-4080-96e6-870236a3e87b",
  "name": "Complete LinkStack Initial Setup and Sign In",
  "tcId": "TC-204",
  "network": (process.env.NETWORK ?? "false").toLowerCase() === "true",
  "autoHealVersion": "AH2",
  "defaultActionTimeoutMs": 10000,
  "defaultNavigationTimeoutMs": 60000,
  "kaneRunV4": true
});

testmu.test("Complete LinkStack Initial Setup and Sign In", async (page) => {
  let element_8, element_9, element_10, element_0, element_1, element_2, element_3, element_15, element_4, element_5, element_18, element_6, element_7, element_21;
  await testmu.step("Navigate to http://localhost:8190/", { instructionId: "71281463-8ac9-4305-9f2b-98e0f4620ddf" }, async () => {
    await page.goto("http://localhost:8190/");
  });
  
  await testmu.step("Reading the Setup LinkStack page heading", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("setup_linkstack_page_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {3: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(3).textContent.trim());\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=heading[name=\"Setup LinkStack\"i]"], query: "the Setup LinkStack page heading", expectedValue: "Setup LinkStack", needsUnitConversion: false, operator: "equals", transforms: ["strip"], condition: "The \"Setup LinkStack\" page is shown." }));
  });
  
  await testmu.step("Checking whether the LinkStack setup welcome text is present", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("setup_linkstack_welcome_text_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {4: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(4).textContent.includes('Welcome to the setup for LinkStack!'));\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:text=\"Welcome to the setup for\"i"], query: "whether the LinkStack setup welcome text is present", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "The text \"Welcome to the setup for LinkStack!\" is shown." }));
  });
  
  await testmu.step("Assertion check", { instructionId: "d7b6c168-d31a-4084-b662-45c839e2cbc2" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "The \"Setup LinkStack\" page is shown.", "passed": true, "operator": "equals", "transforms": ["strip"], "json_path": null, "expected": "Setup LinkStack", "extracted_value": "{{setup_linkstack_page_shown}}", "store_key": "setup_linkstack_page_shown", "variable_refs": {"{{setup_linkstack_page_shown}}": "Setup LinkStack"}}, {"description": "The text \"Welcome to the setup for LinkStack!\" is shown.", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{setup_linkstack_welcome_text_shown}}", "store_key": "setup_linkstack_welcome_text_shown", "variable_refs": {"{{setup_linkstack_welcome_text_shown}}": "true"}}], "sub_checks": [{"description": "The \"Setup LinkStack\" page is shown.", "store_key": "setup_linkstack_page_shown", "expected_value": "Setup LinkStack", "extracted_value": "{{setup_linkstack_page_shown}}", "operator": "equals", "transforms": ["strip"]}, {"description": "The text \"Welcome to the setup for LinkStack!\" is shown.", "store_key": "setup_linkstack_welcome_text_shown", "expected_value": "true", "extracted_value": "{{setup_linkstack_welcome_text_shown}}", "operator": "equals", "transforms": []}], "composite_operator": "and", "claim": "the \"Setup LinkStack\" page is shown with the text \"Welcome to the setup for LinkStack!\""});
  });
  
  await testmu.step("Clicking Next link under the language selector on the Setup page", { instructionId: "9e0442d6-d9f3-4b01-b105-ffd6d5638e93" }, async () => {
    element_8 = page.locator("internal:role=link[name=\"Next\"i]");
    await element_8.click();
  });
  
  await testmu.step("Checking whether the Dependency check page is shown", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("dependency_check_page_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {3: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(3).textContent.trim() === 'Dependency check');\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=heading[name=\"Dependency check\"i]"], query: "whether the Dependency check page heading is present", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "The \"Dependency check\" page is shown." }));
  });
  
  await testmu.step("Assertion check", { instructionId: "f274a750-86da-4cdd-a9f8-9e9be4da1119" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "The \"Dependency check\" page is shown.", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{dependency_check_page_shown}}", "store_key": "dependency_check_page_shown", "variable_refs": {"{{dependency_check_page_shown}}": "true"}}], "sub_checks": [{"description": "The \"Dependency check\" page is shown.", "store_key": "dependency_check_page_shown", "expected_value": "true", "extracted_value": "{{dependency_check_page_shown}}", "operator": "equals", "transforms": []}], "composite_operator": "and", "claim": "the \"Dependency check\" page is shown"});
  });
  
  await testmu.step("Clicking Next link", { instructionId: "6cb1b95a-74b4-4d2a-a61f-43cb75e05690" }, async () => {
    element_9 = page.locator("internal:role=link[name=\"Next\"i]");
    await element_9.click();
  });
  
  await testmu.step("Checking whether the database type selection page is shown", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("select_database_type_page_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {12: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(12) !== null && Array.from(el(12).options).map(o => o.textContent.trim()).includes('SQLite') && Array.from(el(12).options).map(o => o.textContent.trim()).includes('MySQL'));\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=combobox"], query: "whether the database type selection control is present on the setup page", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "the \"Select a database type\" page is shown" }));
  });
  
  await testmu.step("Assertion check", { instructionId: "e4944618-b4d7-492e-b24e-416819098116" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "the \"Select a database type\" page is shown", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{select_database_type_page_shown}}", "store_key": "select_database_type_page_shown", "variable_refs": {"{{select_database_type_page_shown}}": "true"}}], "sub_checks": [{"description": "the \"Select a database type\" page is shown", "store_key": "select_database_type_page_shown", "expected_value": "true", "extracted_value": "{{select_database_type_page_shown}}", "operator": "equals", "transforms": []}], "composite_operator": "and", "claim": "the \"Select a database type\" page is shown"});
  });
  
  await testmu.step("Clicking Next to proceed to the next setup step", { instructionId: "42cfdaef-0045-4d19-98e6-e39d1f9f869f" }, async () => {
    element_10 = page.locator("internal:role=button[name=\"Next\"i]");
    await element_10.click();
  });
  
  await testmu.step("Waiting for admin-account setup page to finish loading", { instructionId: "1d97eb71-f156-4209-a771-40963167bb2f" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Checking whether the Admin email field is shown", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("admin_email_field_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {4: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (!![...el(4).querySelectorAll('input')].find(e => e.type === 'email' && e.required));\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:text=\"Admin email: Admin password: Handle: @ Name: Next\"i"], query: "whether the Admin email field is present in the create-admin-account form", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "the \"Admin email\" field is shown" }));
  });
  
  await testmu.step("Checking whether the Admin password field is shown", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("admin_password_field_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {4: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (!![...el(4).querySelectorAll('input')].find(e => e.type === 'password' && e.required));\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:text=\"Admin email: Admin password: Handle: @ Name: Next\"i"], query: "whether the Admin password field is present in the create-admin-account form", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "the \"Admin password\" field is shown" }));
  });
  
  await testmu.step("whether the Create an admin account page message is visible", { instructionId: "b660b121-f2e8-4e10-bf1b-5b1855f9ead2" }, async () => {
    setVar("create_admin_account_page_shown", await testmu.visionQuery(page, "whether the Create an admin account page message is visible", ""));
  });
  
  await testmu.step("Assertion check", { instructionId: "89eac583-3ad0-4d1b-a976-7beabd6c4294" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "the \"Create an admin account.\" page is shown", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{create_admin_account_page_shown}}", "store_key": "create_admin_account_page_shown", "variable_refs": {"{{create_admin_account_page_shown}}": "true"}}, {"description": "the \"Admin email\" field is shown", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{admin_email_field_shown}}", "store_key": "admin_email_field_shown", "variable_refs": {"{{admin_email_field_shown}}": "true"}}, {"description": "the \"Admin password\" field is shown", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{admin_password_field_shown}}", "store_key": "admin_password_field_shown", "variable_refs": {"{{admin_password_field_shown}}": "true"}}], "sub_checks": [{"description": "the \"Create an admin account.\" page is shown", "store_key": "create_admin_account_page_shown", "expected_value": "true", "extracted_value": "{{create_admin_account_page_shown}}", "operator": "equals", "transforms": []}, {"description": "the \"Admin email\" field is shown", "store_key": "admin_email_field_shown", "expected_value": "true", "extracted_value": "{{admin_email_field_shown}}", "operator": "equals", "transforms": []}, {"description": "the \"Admin password\" field is shown", "store_key": "admin_password_field_shown", "expected_value": "true", "extracted_value": "{{admin_password_field_shown}}", "operator": "equals", "transforms": []}], "composite_operator": "and", "claim": "the \"Create an admin account.\" page is shown with \"Admin email\" and \"Admin password\" fields"});
  });
  
  await testmu.step("Waiting for the plan to queue", { instructionId: "07f33f2b-aab9-40dd-b16b-d00b7a37fb4e" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Type \"alex@example.com\" into \"admin@admin.com\"", { instructionId: "ce188176-5011-4bfc-9d56-8582e26c056d" }, async () => {
    element_0 = page.locator("internal:role=textbox[name=\"admin@admin.com\"i]");
    await element_0.click();
    await element_0.fill("alex@example.com");
  });
  
  await testmu.step("Type \"LinkStack-Test-2026\" into \"12345678\"", { instructionId: "8b572156-c5b7-4b37-ac87-8c58b12a27c8" }, async () => {
    element_1 = page.locator("internal:role=textbox[name=\"12345678\"i]");
    await element_1.click();
    await element_1.fill("LinkStack-Test-2026");
  });
  
  await testmu.step("Waiting for the queued plan to run", { instructionId: "6ade7718-f5f2-4c17-8538-1ef246fcfb94" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Type \"alexmorgan\" into \"textbox\"", { instructionId: "ae45bffe-c5d0-4f5f-800f-5107e9852d60" }, async () => {
    element_2 = page.locator("input[name=\"handle\"]");
    await element_2.click();
    await element_2.fill("alexmorgan");
  });
  
  await testmu.step("Typing Alex Morgan into the name field", { instructionId: "37870b9e-9d8d-4f9a-91a9-0e328fdadbb1" }, async () => {
    element_3 = page.locator("input[name=\"name\"]");
    await element_3.click();
    await element_3.fill("Alex Morgan");
  });
  
  await testmu.step("Clicking Next to continue admin account setup", { instructionId: "4088c04c-5c23-453e-a464-c8a72a09640c" }, async () => {
    element_15 = page.locator("internal:role=button[name=\"Next\"i]");
    await element_15.click();
  });
  
  await testmu.step("Waiting for the page setup to finish loading", { instructionId: "a831be3d-2738-4f7b-bdea-6b4f33397485" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Checking whether the Configure your page page is shown", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("configure_your_page_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {1: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(1).textContent.includes('Configure your page'));\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:text=\"Setup LinkStack Configure\"i"], query: "whether the Configure your page page is shown", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "the \"Configure your page\" page is shown" }));
  });
  
  await testmu.step("Assertion check", { instructionId: "8176f411-12f0-4f47-a875-830b106fd957" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "the \"Configure your page\" page is shown", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{configure_your_page_shown}}", "store_key": "configure_your_page_shown", "variable_refs": {"{{configure_your_page_shown}}": "true"}}], "sub_checks": [{"description": "the \"Configure your page\" page is shown", "store_key": "configure_your_page_shown", "expected_value": "true", "extracted_value": "{{configure_your_page_shown}}", "operator": "equals", "transforms": []}], "composite_operator": "and", "claim": "the \"Configure your page\" page is shown"});
  });
  
  await testmu.step("Waiting for the queued setup steps to complete", { instructionId: "5aba6b86-5fca-4560-ae3b-1a71af804da7" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Select \"No\" in \"combobox\"", { instructionId: "808fd508-45aa-4a80-b7f6-f312f83c6be4" }, async () => {
    element_4 = page.locator("select[name=\"register\"]");
    await element_4.selectOption({ label: "No" });
  });
  
  await testmu.step("Select \"No\" in \"combobox\"", { instructionId: "eacbf42c-dc50-4c95-86fd-3f32580e630c" }, async () => {
    element_5 = page.locator("select[name=\"verify\"]");
    await element_5.selectOption({ label: "No" });
  });
  
  await testmu.step("Waiting for the setup selectors to remain set to No", { instructionId: "311b4dc6-6f06-4ba9-82ce-6ece077b8ed3" }, async () => {
    await page.waitForTimeout(500);
  });
  
  await testmu.step("Clicking Finish setup button", { instructionId: "623cd1e3-3e41-4f9c-afd3-53d9b8406d8f" }, async () => {
    element_18 = page.locator("internal:role=button[name=\"Finish setup\"i]");
    await element_18.click();
  });
  
  await testmu.step("Waiting for the Sign In page to finish loading", { instructionId: "3b36a5fe-7afc-4333-b9ed-7130fa4dcbcb" }, async () => {
    await page.waitForTimeout(800);
  });
  
  await testmu.step("Checking whether the Sign In page is shown", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("sign_in_page_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {5: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(5).textContent.trim() === 'Sign In');\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=heading[name=\"Sign In\"i]"], query: "whether the Sign In page heading is present", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "The \"Sign In\" page is shown." }));
  });
  
  await testmu.step("Assertion check", { instructionId: "13c84a86-98e0-44b7-bf5e-6babd50e4998" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "The \"Sign In\" page is shown.", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{sign_in_page_shown}}", "store_key": "sign_in_page_shown", "variable_refs": {"{{sign_in_page_shown}}": "true"}}], "sub_checks": [{"description": "The \"Sign In\" page is shown.", "store_key": "sign_in_page_shown", "expected_value": "true", "extracted_value": "{{sign_in_page_shown}}", "operator": "equals", "transforms": []}], "composite_operator": "and", "claim": "the \"Sign In\" page is shown"});
  });
  
  await testmu.step("Waiting for queued plan steps to complete", { instructionId: "4b83a1f8-863b-49ef-b726-19502b187645" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Type \"alex@example.com\" into \"Email\"", { instructionId: "aa1e4dd9-6d1d-41e5-aa13-e5bd811bb993" }, async () => {
    element_6 = page.locator("internal:role=textbox[name=\"Email\"i]");
    await element_6.click();
    await element_6.fill("alex@example.com");
  });
  
  await testmu.step("Type \"LinkStack-Test-2026\" into \"Password\"", { instructionId: "da269a92-49cd-462b-9b50-a63118147ff7" }, async () => {
    element_7 = page.locator("internal:role=textbox[name=\"Password\"i]");
    await element_7.click();
    await element_7.fill("LinkStack-Test-2026");
  });
  
  await testmu.step("Clicking the Sign In submit button", { instructionId: "befc900e-0d08-4077-866c-0839a825d936" }, async () => {
    element_21 = page.locator("internal:role=button[name=\"Sign In\"i]");
    await element_21.click();
  });
  
  await testmu.step("Waiting 1000 ms for the dashboard page to finish loading", { instructionId: "bea27277-0e31-4c56-a456-269704012ff9" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Reading the Dashboard page heading", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("dashboard_shown_check", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {56: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(56).textContent.trim());\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=heading[name=\"\uf48c Dashboard\"i]"], query: "the Dashboard page heading", expectedValue: "Dashboard", needsUnitConversion: false, operator: "contains", transforms: ["strip"], condition: "The dashboard is shown." }));
  });
  
  await testmu.step("Reading the dashboard greeting", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("dashboard_greeting_check", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {53: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(53).textContent.trim());\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=heading[name=\"\ud83d\udc4b Hi, @alexmorgan\"i]"], query: "the user greeting in the dashboard header", expectedValue: "Hi, @alexmorgan", needsUnitConversion: false, operator: "contains", transforms: ["strip"], condition: "The greeting \"Hi, @alexmorgan\" is shown." }));
  });
  
  await testmu.step("Reading the Total Links dashboard summary", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("total_links_check", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {58: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(58).textContent.trim());\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:text=\"Total Links:\"i"], query: "the Total Links count displayed in the dashboard summary", expectedValue: "Total Links: 0", needsUnitConversion: false, operator: "contains", transforms: ["strip"], condition: "\"Total Links: 0\" is shown." }));
  });
  
  await testmu.step("Assertion check", { instructionId: "75eb9606-2d9b-4664-84a4-1edfb4911e82" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "The dashboard is shown.", "passed": true, "operator": "contains", "transforms": ["strip"], "json_path": null, "expected": "Dashboard", "extracted_value": "{{dashboard_shown_check}}", "store_key": "dashboard_shown_check", "variable_refs": {"{{dashboard_shown_check}}": "Dashboard"}}, {"description": "The greeting \"Hi, @alexmorgan\" is shown.", "passed": true, "operator": "contains", "transforms": ["strip"], "json_path": null, "expected": "Hi, @alexmorgan", "extracted_value": "{{dashboard_greeting_check}}", "store_key": "dashboard_greeting_check", "variable_refs": {"{{dashboard_greeting_check}}": "\ud83d\udc4b Hi, @alexmorgan"}}, {"description": "\"Total Links: 0\" is shown.", "passed": true, "operator": "contains", "transforms": ["strip"], "json_path": null, "expected": "Total Links: 0", "extracted_value": "{{total_links_check}}", "store_key": "total_links_check", "variable_refs": {"{{total_links_check}}": "Total Links: 0"}}], "sub_checks": [{"description": "The dashboard is shown.", "store_key": "dashboard_shown_check", "expected_value": "Dashboard", "extracted_value": "{{dashboard_shown_check}}", "operator": "contains", "transforms": ["strip"]}, {"description": "The greeting \"Hi, @alexmorgan\" is shown.", "store_key": "dashboard_greeting_check", "expected_value": "Hi, @alexmorgan", "extracted_value": "{{dashboard_greeting_check}}", "operator": "contains", "transforms": ["strip"]}, {"description": "\"Total Links: 0\" is shown.", "store_key": "total_links_check", "expected_value": "Total Links: 0", "extracted_value": "{{total_links_check}}", "operator": "contains", "transforms": ["strip"]}], "composite_operator": "and", "claim": "the dashboard is shown with the greeting \"Hi, @alexmorgan\" and \"Total Links: 0\"."});
  });
});

testmu.run();