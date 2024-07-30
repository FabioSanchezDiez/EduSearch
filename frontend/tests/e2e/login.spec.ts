import { test, expect } from "@playwright/test";

test("Login page test", async ({ page }) => {
  await page.goto("http://localhost:3000/accounts/login");

  const emailInput = page.locator('input[type="email"]');
  await expect(emailInput).toHaveCount(1);

  const passwordInput = page.locator('input[type="password"]');
  await expect(passwordInput).toHaveCount(1);

  const submitButton = page.locator('button[type="submit"]');
  await expect(submitButton).toHaveCount(1);

  await emailInput.fill("test@example.com");
  await passwordInput.fill("password");

  await submitButton.click();

  const alertDiv = page.locator('div[role="alert"]');
  await expect(alertDiv).toHaveCount(1);
});
