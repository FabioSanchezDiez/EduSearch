import LoginForm from "@/components/ui/auth/login-form";

export default function LoginPage() {
  return (
    <>
      <div className="space-y-8 flex flex-col items-center">
        <h1 className="text-xl font-semibold">Inicia Sesión con tu cuenta</h1>
        <LoginForm></LoginForm>
      </div>
    </>
  );
}
