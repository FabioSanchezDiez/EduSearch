import LoginForm from "@/components/ui/auth/login-form";
import Link from "next/link";

export default function LoginPage() {
  return (
    <>
      <div className="flex flex-col items-center">
        <LoginForm></LoginForm>
        <div className="mt-6">
          <p>
            ¿Todavía no tienes una cuenta? Regístrate{" "}
            <Link href={"/accounts/register"}>
              <span className="text-primary font-bold">pulsando aquí</span>
            </Link>
          </p>
        </div>
      </div>
    </>
  );
}
