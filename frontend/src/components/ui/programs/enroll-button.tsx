"use client";

import { useSession } from "next-auth/react";
import { useRouter } from "next/navigation";
import { useState } from "react";
import { Button } from "../button";
import { DASHBOARD_PAGE_ROUTE, LOGIN_PAGE_ROUTE } from "@/lib/routes";
import Loader from "../loader";
import { enrollUserInProgram } from "@/lib/data";

import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog";

export default function EnrollButton({ programId }: { programId: string }) {
  const [isLoading, setIsLoading] = useState(false);
  const [isSuccess, setIsSuccess] = useState<boolean>(false);
  const [errors, setErrors] = useState<string[]>([]);

  const { data: session } = useSession();
  const router = useRouter();

  const handleOnClick = async () => {
    if (!session?.user) {
      router.push(LOGIN_PAGE_ROUTE);
      return;
    }
    setIsLoading(true);
    const response = await enrollUserInProgram(
      session?.user.email!,
      programId,
      session?.user.token!
    );
    setIsLoading(false);

    if (response.error) {
      setIsLoading(false);
      setErrors(["Ocurrió un fallo inesperado"]);
      return;
    }

    setIsSuccess(true);
    setIsLoading(false);

    setTimeout(() => {
      router.push(DASHBOARD_PAGE_ROUTE);
    }, 2000);
  };

  return (
    <>
      {isLoading && <Loader></Loader>}

      <div className="flex flex-col gap-2 text-center">
        {!isSuccess ? (
          <>
            <h3 className="text-xl font-medium">¿Estudias esto actualmente?</h3>
            <AlertDialog>
              <AlertDialogTrigger className="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                Seleccionar este programa
              </AlertDialogTrigger>
              <AlertDialogContent>
                <AlertDialogHeader>
                  <AlertDialogTitle>¿Estás seguro?</AlertDialogTitle>
                  <AlertDialogDescription>
                    Si seleccionas que actualmente estás estudiando este
                    programa se eliminará de tu selección el programa que
                    estabas estudiando anteriormente y tus recomendaciones serán
                    distintas.
                  </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                  <AlertDialogCancel>Cancelar</AlertDialogCancel>
                  <AlertDialogAction onClick={handleOnClick}>
                    Continuar
                  </AlertDialogAction>
                </AlertDialogFooter>
              </AlertDialogContent>
            </AlertDialog>
          </>
        ) : (
          <p className="text-xl font-medium text-green-400">
            Programa seleccionado con éxito, redirigiendo a su zona personal.
          </p>
        )}
      </div>
    </>
  );
}
