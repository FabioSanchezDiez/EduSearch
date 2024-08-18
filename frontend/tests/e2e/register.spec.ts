import { test, expect } from "@playwright/test";
import { AuthPage } from "./pages/AuthPage";
import { REGISTER_PAGE_ROUTE } from "@/lib/routes";

test("Register page test", async ({ page }) => {
  const registerPage = new AuthPage(page);

  await test.step("Load page", async () => {
    await registerPage.goto(REGISTER_PAGE_ROUTE);
  });

  await test.step("Find and fill inputs and submit them", async () => {
    await expect(registerPage.usernameInput).toHaveCount(1);
    await expect(registerPage.emailInput).toHaveCount(1);
    await expect(registerPage.passwordInput).toHaveCount(1);
    await expect(registerPage.provinceInput).toHaveCount(1);
    await expect(registerPage.submitButton).toHaveCount(1);

    await registerPage.register(
      "TestUser",
      "test@example.com",
      "password",
      "Granada"
    );
  });

  await test.step("Find feedback alert", async () => {
    await expect(registerPage.alertDiv).toHaveCount(1);
  });
});
