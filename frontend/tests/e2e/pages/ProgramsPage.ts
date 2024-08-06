import { Locator } from "@playwright/test";
import { BasePage } from "./BasePage";

export class ProgramsPage extends BasePage {
  get computerScienceField(): Locator {
    return this.page.locator('p:has-text("Informática y Comunicaciones")');
  }

  get webDevelopmentPrograms(): Locator {
    return this.page.locator(
      'p:has-text("Técnico Superior en Desarrollo de Aplicaciones Web")'
    );
  }

  async clickComputerScienceField(): Promise<void> {
    await this.computerScienceField.click();
  }

  async clickWebDevelopmentPrograms(): Promise<void> {
    await this.webDevelopmentPrograms.click();
  }
}
