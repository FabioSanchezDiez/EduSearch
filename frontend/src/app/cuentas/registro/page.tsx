import RegisterForm from "@/components/ui/auth/register-form";
import { LOGIN_PAGE_ROUTE } from "@/lib/routes";
import Link from "next/link";

export default function RegisterPage() {
  return (
    <>
      <div className="flex flex-col items-center">
        <RegisterForm></RegisterForm>
        <div className="mt-6">
          <p>
            ¿Ya tienes una cuenta? Inicia sesión{" "}
            <Link href={LOGIN_PAGE_ROUTE}>
              <span className="text-primary font-bold">pulsando aquí</span>
            </Link>
          </p>
        </div>
      </div>
    </>
  );
}
