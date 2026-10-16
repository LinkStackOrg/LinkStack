import testmu, { resolveVar, setVar } from '@testmuai/playwright-bindings';
import { expect } from '@playwright/test';

testmu.configure({
  "build": "2321e03b-16c8-4b21-b12f-018f130020d7",
  "name": "Add and Verify a GitHub Link",
  "tcId": "TC-205",
  "network": (process.env.NETWORK ?? "false").toLowerCase() === "true",
  "autoHealVersion": "AH2",
  "defaultActionTimeoutMs": 10000,
  "defaultNavigationTimeoutMs": 60000,
  "kaneRunV4": true
});

testmu.test("Add and Verify a GitHub Link", async (page) => {
  let element_0, element_1, element_5, element_6, element_2, element_3, element_4, element_10, element_11;
  await testmu.step("Navigate to http://localhost:8190/login", { instructionId: "65adfa32-16c5-4495-9a29-26a323d38f64" }, async () => {
    await page.goto("http://localhost:8190/login");
  });
  
  await testmu.step("Waiting for the next action to complete", { instructionId: "5137e257-7ed0-4fc0-acbe-3e4e1b8b2883" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Type \"alex@example.com\" into \"Email\"", { instructionId: "d7d64fca-6e55-4bc5-b5ea-5c359fe65b6c" }, async () => {
    element_0 = page.locator("internal:role=textbox[name=\"Email\"i]");
    await element_0.click();
    await element_0.fill("alex@example.com");
  });
  
  await testmu.step("Type \"LinkStack-Test-2026\" into \"Password\"", { instructionId: "2ff998af-37e7-4cdc-a182-5bf2c1daf8f8" }, async () => {
    element_1 = page.locator("internal:role=textbox[name=\"Password\"i]");
    await element_1.click();
    await element_1.fill("LinkStack-Test-2026");
  });
  
  await testmu.step("Clicking the Sign In submit button", { instructionId: "0f3af0d7-de19-47f9-b5b6-c1560d9b116c" }, async () => {
    element_5 = page.locator("internal:role=button[name=\"Sign In\"i]");
    await element_5.click();
  });
  
  await testmu.step("Waiting for the dashboard page to finish loading", { instructionId: "d740d116-79d3-426d-af47-df3d16b2cc97" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Checking whether the Dashboard heading is present", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("dashboard_shown_check", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {56: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(56).textContent.includes('Dashboard'));\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=heading[name=\"\uf48c Dashboard\"i]"], query: "whether the Dashboard heading is present in the main content", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "The dashboard is shown." }));
  });
  
  await testmu.step("Reading the dashboard greeting", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("dashboard_greeting_check", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {53: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(53).textContent.trim());\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=heading[name=\"\ud83d\udc4b Hi, @alexmorgan\"i]"], query: "the greeting displayed in the dashboard header", expectedValue: "Hi, @alexmorgan", needsUnitConversion: false, operator: "contains", transforms: ["strip"], condition: "The greeting \"Hi, @alexmorgan\" is displayed." }));
  });
  
  await testmu.step("Assertion check", { instructionId: "bb4857f2-8356-438f-8c47-5f7075ee796a" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "The dashboard is shown.", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{dashboard_shown_check}}", "store_key": "dashboard_shown_check", "variable_refs": {"{{dashboard_shown_check}}": "true"}}, {"description": "The greeting \"Hi, @alexmorgan\" is displayed.", "passed": true, "operator": "contains", "transforms": ["strip"], "json_path": null, "expected": "Hi, @alexmorgan", "extracted_value": "{{dashboard_greeting_check}}", "store_key": "dashboard_greeting_check", "variable_refs": {"{{dashboard_greeting_check}}": "\ud83d\udc4b Hi, @alexmorgan"}}], "sub_checks": [{"description": "The dashboard is shown.", "store_key": "dashboard_shown_check", "expected_value": "true", "extracted_value": "{{dashboard_shown_check}}", "operator": "equals", "transforms": []}, {"description": "The greeting \"Hi, @alexmorgan\" is displayed.", "store_key": "dashboard_greeting_check", "expected_value": "Hi, @alexmorgan", "extracted_value": "{{dashboard_greeting_check}}", "operator": "contains", "transforms": ["strip"]}], "composite_operator": "and", "claim": "the dashboard is shown with the greeting \"Hi, @alexmorgan\""});
  });
  
  await testmu.step("Clicking Add Link in the left sidebar", { instructionId: "a43b5211-fbd3-41a5-8bdc-95daae9db5cd" }, async () => {
    element_6 = page.locator("internal:role=link[name=\"Add Link\"i]");
    await element_6.click();
  });
  
  await testmu.step("Waiting for the queued plan to run", { instructionId: "c1693154-6811-4620-bc03-c324b8a965d2" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Select \"GitHub\" in \"combobox\"", { instructionId: "59a7d895-acdd-4991-816e-b723f06cb953" }, async () => {
    element_2 = page.locator("internal:role=combobox");
    await element_2.selectOption({ label: "GitHub" });
  });
  
  await testmu.step("Type \"My GitHub\" into \"textbox\"", { instructionId: "5157c0c2-8455-4ca5-9f24-47b9e4c754d4" }, async () => {
    element_3 = page.locator("input[name=\"title\"]");
    await element_3.click();
    await element_3.fill("My GitHub");
  });
  
  await testmu.step("Type \"https://github.com/alexmorgan\" into \"textbox\"", { instructionId: "94e82eae-d1f0-4a3e-8b25-551842291d06" }, async () => {
    element_4 = page.locator("input[name=\"link\"]");
    await element_4.click();
    await element_4.fill("https://github.com/alexmorgan");
  });
  
  await testmu.step("Click \"Save\"", { instructionId: "7c01d52e-7c3e-4233-884f-a206dd2411d3" }, async () => {
    element_10 = page.locator("internal:role=button[name=\"Save\"s]");
    await element_10.click();
  });
  
  await testmu.step("Waiting briefly after confirming the saved GitHub link configuration", { instructionId: "a0223a20-ab65-4f2b-aa85-7798d78c3233" }, async () => {
    await page.waitForTimeout(200);
  });
  
  await testmu.step("Navigate to http://localhost:8190/@alexmorgan", { instructionId: "d5156854-79ab-42ed-8c1c-834492d8911c" }, async () => {
    await page.goto("http://localhost:8190/@alexmorgan");
  });
  
  await testmu.step("Waiting briefly for the public profile to settle", { instructionId: "deedd7a3-32be-4034-b216-e4c6050eab6a" }, async () => {
    await page.waitForTimeout(1000);
  });
  
  await testmu.step("Checking whether the My GitHub button is present", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("my_github_button_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {27: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(27).textContent.includes('My GitHub'));\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=link[name=\"githubMy GitHub\"i]"], query: "whether the My GitHub profile link is present on the public page", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "The public page shows a \"My GitHub\" button." }));
  });
  
  await testmu.step("Reading the displayed public profile name", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("alex_morgan_name_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {25: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (Array.from(el(25).childNodes).filter(n=>n.nodeType===Node.TEXT_NODE).map(n=>n.textContent).join('').trim());\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=heading[name=\"Alex Morgan\"i]"], query: "the displayed profile name in the public page heading", expectedValue: "Alex Morgan", needsUnitConversion: false, operator: "equals", transforms: [], condition: "The public page shows the name \"Alex Morgan\"." }));
  });
  
  await testmu.step("Clicking Edit in the navigation sidebar", { instructionId: "abdee34b-1ba2-4103-bb51-a1485af31d97" }, async () => {
    element_11 = page.locator("internal:role=link[name=\"Edit Edit\"i]");
    await element_11.click();
  });
  
  await testmu.step("Checking whether the Links page is shown", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("links_page_shown", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {57: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(57).textContent.includes('My Links'));\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:role=heading[name=\"\uf470 My Links Add new Link\"i]"], query: "whether the Links page heading is present", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "The \"Links\" page is shown." }));
  });
  
  await testmu.step("Checking whether My GitHub is listed", async () => {
    await page.waitForLoadState("domcontentloaded", { timeout: 5000 });
    setVar("my_github_listed", await testmu.textualAnalyzer(page, { wrappedJs: "(els) => {\n  const __m = {60: 0};\n  const el = (i) => els[__m[i]];\n  const __v = (el(60).getAttribute('aria-description') === 'My GitHub' || el(60).getAttribute('aria-label') === 'My GitHub' || el(60).textContent.includes('My GitHub'));\n  return (typeof __v === 'boolean' ? String(__v) : __v);\n}", locators: ["internal:text=\"My GitHub https://github.com/\"i"], query: "whether the My GitHub link item is listed", expectedValue: "true", needsUnitConversion: false, operator: "equals", transforms: [], condition: "The page lists \"My GitHub\"." }));
  });
  
  await testmu.step("Assertion check", { instructionId: "a35bb4f5-a830-4b6e-90fb-3a45fe83f84f" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "The \"Links\" page is shown.", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{links_page_shown}}", "store_key": "links_page_shown", "variable_refs": {"{{links_page_shown}}": "true"}}, {"description": "The page lists \"My GitHub\".", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{my_github_listed}}", "store_key": "my_github_listed", "variable_refs": {"{{my_github_listed}}": "true"}}], "sub_checks": [{"description": "The \"Links\" page is shown.", "store_key": "links_page_shown", "expected_value": "true", "extracted_value": "{{links_page_shown}}", "operator": "equals", "transforms": []}, {"description": "The page lists \"My GitHub\".", "store_key": "my_github_listed", "expected_value": "true", "extracted_value": "{{my_github_listed}}", "operator": "equals", "transforms": []}], "composite_operator": "and", "claim": "the \"Links\" page is shown and lists \"My GitHub\""});
  });
  
  await testmu.step("Assertion check", { instructionId: "73a23b7d-ad43-4b84-8f55-3d939f0cf2de" }, async () => {
    await testmu.verifyAssertion(page, "Assertion check", {"operator": ["equals"], "assertion_operands": [], "left_operand": null, "right_operand": null, "operands": [], "sub_results": [{"description": "The public page shows the name \"Alex Morgan\".", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "Alex Morgan", "extracted_value": "{{alex_morgan_name_shown}}", "store_key": "alex_morgan_name_shown", "variable_refs": {"{{alex_morgan_name_shown}}": "Alex Morgan"}}, {"description": "The public page shows a \"My GitHub\" button.", "passed": true, "operator": "equals", "transforms": [], "json_path": null, "expected": "true", "extracted_value": "{{my_github_button_shown}}", "store_key": "my_github_button_shown", "variable_refs": {"{{my_github_button_shown}}": "true"}}], "sub_checks": [{"description": "The public page shows the name \"Alex Morgan\".", "store_key": "alex_morgan_name_shown", "expected_value": "Alex Morgan", "extracted_value": "{{alex_morgan_name_shown}}", "operator": "equals", "transforms": []}, {"description": "The public page shows a \"My GitHub\" button.", "store_key": "my_github_button_shown", "expected_value": "true", "extracted_value": "{{my_github_button_shown}}", "operator": "equals", "transforms": []}], "composite_operator": "and", "claim": "the public page shows the name \"Alex Morgan\" and a \"My GitHub\" button"});
  });
});

testmu.run();