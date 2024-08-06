import { test } from "@playwright/test";
import { ProgramsPage } from "./pages/ProgramsPage";

test("Programs page test", async ({ page }) => {
  const programsPage = new ProgramsPage(page);

  await test.step("Load page", async () => {
    await programsPage.goto("/programs");
  });

  await test.step("Find computer science field and click it", async () => {
    await programsPage.clickComputerScienceField();
  });

  await test.step("Find web development programs and click it", async () => {
    await programsPage.clickWebDevelopmentPrograms();
  });
});
