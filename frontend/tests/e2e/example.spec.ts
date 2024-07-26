import { test, expect } from "@playwright/test";

test("should navigate to the about page", async ({ page }) => {
  await page.goto("http://localhost:3000/");
  const aboutButton = page.locator('button:has-text("Sobre el proyecto")');
  await expect(aboutButton).toBeVisible();
  await expect(aboutButton).toContainText("Sobre el proyecto");
});
