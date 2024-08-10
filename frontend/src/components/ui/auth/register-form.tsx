"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";

import { zodResolver } from "@hookform/resolvers/zod";
import { Check, ChevronsUpDown } from "lucide-react";
import { useForm } from "react-hook-form";
import { z } from "zod";
import { cn } from "@/lib/utils";

import Loader from "../loader";
import { Button } from "@/components/ui/button";
import {
  Command,
  CommandEmpty,
  CommandGroup,
  CommandInput,
  CommandItem,
  CommandList,
} from "@/components/ui/command";
import {
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover";
import { Input } from "@/components/ui/input";
import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert";
import { AlertCircle, CircleCheck } from "lucide-react";
import { registerUser } from "@/lib/data";

const formSchema = z.object({
  username: z
    .string()
    .min(2, {
      message: "El nombre de usuario debe tener al menos 2 caracteres",
    })
    .max(50, {
      message: "El nombre de usuario no puede tener más de 50 caracteres",
    }),
  email: z.string().email({ message: "El correo electrónico no es válido" }),
  password: z
    .string()
    .min(4, { message: "La contraseña debe tener al menos 4 caracteres" })
    .max(255, {
      message: "La contraseña no puede tener más de 255 caracteres",
    }),
  province: z.string({
    required_error: "Por favor, seleccione una provincia",
  }),
});

const provinces = [
  { label: "Granada", value: "granada" },
  { label: "Almería", value: "almeria" },
  { label: "Cádiz", value: "cadiz" },
  { label: "Córdoba", value: "cordoba" },
  { label: "Huelva", value: "huelva" },
  { label: "Jaén", value: "jaen" },
  { label: "Málaga", value: "malaga" },
  { label: "Sevilla", value: "sevilla" },
  { label: "Prefiero no decirlo", value: "N/A" },
] as const;

export default function RegisterForm() {
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [isSuccess, setIsSuccess] = useState<boolean>(false);
  const [errors, setErrors] = useState<string[]>([]);
  const router = useRouter();

  // 1. Define your form.
  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      username: "",
      email: "",
      password: "",
      province: "",
    },
  });

  // 2. Define a submit handler.
  async function onSubmit(values: z.infer<typeof formSchema>) {
    setIsLoading(true);
    const { username, email, password, province } = values;

    const response = await registerUser(username, email, password, province);

    if (response.error) {
      setIsLoading(false);
      setErrors([
        "Este correo ya esta registrado u ocurrió un fallo inesperado",
      ]);
      return;
    }

    setIsSuccess(true);
    setIsLoading(false);

    setTimeout(() => {
      router.push("/");
    }, 2000);
  }

  return (
    <>
      {isLoading && <Loader></Loader>}

      <h1 className="text-xl font-semibold mb-8">
        Registrate en la plataforma
      </h1>

      {isSuccess ? (
        <div className="flex flex-col gap-4 my-4">
          <Alert variant={"success"}>
            <CircleCheck className="h-4 w-4"></CircleCheck>
            <AlertTitle>Éxito</AlertTitle>
            <AlertDescription>
              Cuenta creada correctamente, redirigiendo al inicio de sesión
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
            name="username"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Nombre</FormLabel>
                <FormControl>
                  <Input
                    type="text"
                    placeholder="Escribe tu nombre de usuario"
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
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
          <FormField
            control={form.control}
            name="province"
            render={({ field }) => (
              <FormItem className="flex flex-col">
                <FormLabel>Provincia</FormLabel>
                <Popover>
                  <PopoverTrigger asChild>
                    <FormControl>
                      <Button
                        variant="outline"
                        role="combobox"
                        className={cn(
                          "w-[200px] justify-between",
                          !field.value && "text-muted-foreground"
                        )}
                      >
                        {field.value
                          ? provinces.find(
                              (province) => province.value === field.value
                            )?.label
                          : "Selecciona tu provincia"}
                        <ChevronsUpDown className="ml-2 h-4 w-4 shrink-0 opacity-50" />
                      </Button>
                    </FormControl>
                  </PopoverTrigger>
                  <PopoverContent className="w-[200px] p-0">
                    <Command>
                      <CommandInput placeholder="Buscar provincia..." />
                      <CommandList>
                        <CommandEmpty>Provincia no encontrada.</CommandEmpty>
                        <CommandGroup>
                          {provinces.map((province) => (
                            <CommandItem
                              value={province.label}
                              key={province.value}
                              onSelect={() => {
                                form.setValue("province", province.value);
                              }}
                            >
                              <Check
                                className={cn(
                                  "mr-2 h-4 w-4",
                                  province.value === field.value
                                    ? "opacity-100"
                                    : "opacity-0"
                                )}
                              />
                              {province.label}
                            </CommandItem>
                          ))}
                        </CommandGroup>
                      </CommandList>
                    </Command>
                  </PopoverContent>
                </Popover>
                <FormDescription>
                  Selecciona la provincia en la que resides para que te
                  recomendemos tus opciones más cercanas.
                </FormDescription>
                <FormMessage />
              </FormItem>
            )}
          />
          <Button type="submit">Registrarse</Button>
        </form>
      </Form>
    </>
  );
}
