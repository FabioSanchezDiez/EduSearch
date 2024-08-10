import { Locator, Page } from "@playwright/test";
import { BasePage } from "./BasePage";

export class AuthPage extends BasePage {
  constructor(page: Page) {
    super(page);
  }

  get emailInput(): Locator {
    return this.page.locator('input[type="email"]');
  }

  get passwordInput(): Locator {
    return this.page.locator('input[type="password"]');
  }

  get submitButton(): Locator {
    return this.page.locator('button[type="submit"]');
  }

  get usernameInput(): Locator {
    return this.page.locator('input[type="text"]');
  }

  get provinceInput(): Locator {
    return this.page.locator('button[role="combobox"]');
  }

  get alertDiv(): Locator {
    return this.page.locator('div[role="alert"]');
  }

  async login(email: string, password: string): Promise<void> {
    await this.emailInput.fill(email);
    await this.passwordInput.fill(password);
    await this.submitButton.click();
  }

  async register(
    username: string,
    email: string,
    password: string,
    province: string
  ): Promise<void> {
    await this.usernameInput.fill(username);
    await this.emailInput.fill(email);
    await this.passwordInput.fill(password);

    await this.provinceInput.click();
    const provinceOption = this.page.locator(
      `div[role="option"]:has-text("${province}")`
    );
    await provinceOption.click();

    await this.submitButton.click();
  }
}
