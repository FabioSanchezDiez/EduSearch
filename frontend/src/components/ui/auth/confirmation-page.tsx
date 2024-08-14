"use client";

import { Button } from "@/components/ui/button";
import Loader from "@/components/ui/loader";
import { confirmUser } from "@/lib/data";
import { useRouter } from "next/navigation";
import { useState } from "react";
import { Alert, AlertDescription, AlertTitle } from "../alert";
import { AlertCircle, CircleCheck } from "lucide-react";

export default function ConfirmationPage({ token }: { token: string }) {
  const [errors, setErrors] = useState<string[]>([]);
  const [isSuccess, setIsSuccess] = useState<boolean>(false);
  const [isLoading, setIsLoading] = useState(false);
  const router = useRouter();

  const handleConfirmUser = async () => {
    setIsLoading(true);
    const result = await confirmUser(token);

    if (result.error) {
      setErrors(["Token no válido o usuario ya confirmado"]);
      setIsLoading(false);
      return;
    }
    setIsSuccess(true);
    setIsLoading(false);

    setTimeout(() => {
      router.push("/accounts/login");
    }, 3000);
  };

  return (
    <>
      {isLoading && <Loader></Loader>}

      {isSuccess ? (
        <div className="flex flex-col gap-4 my-4">
          <Alert variant={"success"}>
            <CircleCheck className="h-4 w-4"></CircleCheck>
            <AlertTitle>Éxito</AlertTitle>
            <AlertDescription>
              Cuenta confirmada correctamente, redirigiendo al inicio de sesión.
            </AlertDescription>
          </Alert>
        </div>
      ) : (
        errors.length > 0 && (
          <div className="flex flex-col gap-4 my-4">
            {errors.map((error) => (
              <Alert variant={"destructive"} key={error}>
                <AlertCircle className="h-4 w-4"></AlertCircle>
                <AlertTitle>Error</AlertTitle>
                <AlertDescription>{error}</AlertDescription>
              </Alert>
            ))}
          </div>
        )
      )}
      <div className="flex justify-center flex-col items-center gap-4 mt-20 p-4">
        <h2 className="text-2xl font-bold text-center">
          ¡Estás a un click de confirmar tu cuenta!
        </h2>
        <div className="max-w-3xl">
          <Button onClick={handleConfirmUser}>Confirmar Cuenta</Button>
        </div>
      </div>
    </>
  );
}
