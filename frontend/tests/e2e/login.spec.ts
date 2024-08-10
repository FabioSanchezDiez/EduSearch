import { test, expect } from "@playwright/test";
import { AuthPage } from "./pages/AuthPage";

test("Login page test", async ({ page }) => {
  const loginPage = new AuthPage(page);

  await test.step("Load page", async () => {
    await loginPage.goto("/accounts/login");
  });

  await test.step("Find and fill inputs and submit them", async () => {
    await expect(loginPage.emailInput).toHaveCount(1);
    await expect(loginPage.passwordInput).toHaveCount(1);
    await expect(loginPage.submitButton).toHaveCount(1);

    await loginPage.login("test@example.com", "password");
  });

  await test.step("Find feedback alert", async () => {
    await expect(loginPage.alertDiv).toHaveCount(1);
  });
});
