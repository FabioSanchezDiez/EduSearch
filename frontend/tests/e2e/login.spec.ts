import { test, expect } from "@playwright/test";

test("Login page test", async ({ page }) => {
  await test.step("Load page", async () => {
    await page.goto("http://localhost:3000/accounts/login");
  });

  await test.step("Find and fill inputs and submit them", async () => {
    const emailInput = page.locator('input[type="email"]');
    await expect(emailInput).toHaveCount(1);

    const passwordInput = page.locator('input[type="password"]');
    await expect(passwordInput).toHaveCount(1);

    const submitButton = page.locator('button[type="submit"]');
    await expect(submitButton).toHaveCount(1);

    await emailInput.fill("test@example.com");
    await passwordInput.fill("password");

    await submitButton.click();
  });

  await test.step("Find feedback alert", async () => {
    const alertDiv = page.locator('div[role="alert"]');
    await expect(alertDiv).toHaveCount(1);
  });
});
