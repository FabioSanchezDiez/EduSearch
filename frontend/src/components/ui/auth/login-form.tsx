"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";

import { signIn } from "next-auth/react";

import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import { z } from "zod";

import Loader from "../loader";
import { Button } from "@/components/ui/button";
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert";
import { AlertCircle, CircleCheck } from "lucide-react";
import { DASHBOARD_PAGE_ROUTE } from "@/lib/routes";

const formSchema = z.object({
  email: z.string().email({ message: "El correo electrónico no es válido" }),
  password: z
    .string()
    .min(4, { message: "La contraseña debe tener al menos 4 caracteres" })
    .max(255, {
      message: "La contraseña no puede tener más de 255 caracteres",
    }),
});

export default function LoginForm() {
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [isSuccess, setIsSuccess] = useState<boolean>(false);
  const [errors, setErrors] = useState<string[]>([]);
  const router = useRouter();

  // 1. Define your form.
  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      email: "",
      password: "",
    },
  });

  // 2. Define a submit handler.
  async function onSubmit(values: z.infer<typeof formSchema>) {
    setIsLoading(true);
    const { email, password } = values;

    const response = await signIn("credentials", {
      email,
      password,
      redirect: false,
    });

    if (!response?.ok) {
      setIsLoading(false);
      setErrors(["Credenciales incorrectas o usuario no confirmado"]);
      return;
    }

    setIsSuccess(true);
    setIsLoading(false);

    setTimeout(() => {
      router.push(DASHBOARD_PAGE_ROUTE);
    }, 2000);
  }

  return (
    <>
      {isLoading && <Loader></Loader>}

      <h1 className="text-xl font-semibold mb-8">
        Inicia Sesión con tu cuenta
      </h1>

      {isSuccess ? (
        <div className="flex flex-col gap-4 my-4">
          <Alert variant={"success"}>
            <CircleCheck className="h-4 w-4"></CircleCheck>
            <AlertTitle>Éxito</AlertTitle>
            <AlertDescription>
              Sesión iniciada correctamente, redirigiendo a su zona personal
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

      <Form {...form}>
        <form
          onSubmit={form.handleSubmit(onSubmit)}
          className="space-y-8 w-3/6"
        >
          <FormField
            control={form.control}
            name="email"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Email</FormLabel>
                <FormControl>
                  <Input
                    type="email"
                    placeholder="Escribe tu email"
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
          <FormField
            control={form.control}
            name="password"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Contraseña</FormLabel>
                <FormControl>
                  <Input
                    type="password"
                    placeholder="Escribe tu contraseña"
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
          <Button type="submit" disabled={isSuccess && true}>
            Iniciar Sesión
          </Button>
        </form>
      </Form>
    </>
  );
}
