import LoginForm from "@/components/ui/auth/login-form";
import { REGISTER_PAGE_ROUTE } from "@/lib/routes";
import Link from "next/link";

export default function LoginPage() {
  return (
    <>
      <div className="flex flex-col items-center">
        <LoginForm></LoginForm>
        <div className="mt-6">
          <p>
            ¿Todavía no tienes una cuenta? Regístrate{" "}
            <Link href={REGISTER_PAGE_ROUTE}>
              <span className="text-primary font-bold">pulsando aquí</span>
            </Link>
          </p>
        </div>
      </div>
    </>
  );
}
