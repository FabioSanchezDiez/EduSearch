"use client";

import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import { useRouter } from "next/navigation";
import { useState } from "react";
import { z } from "zod";

import { Button } from "@/components/ui/button";
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { Textarea } from "@/components/ui/textarea";
import { PROGRAMS_PAGE_ROUTE } from "@/lib/routes";
import { submitProgramFeedback } from "@/lib/data";
import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert";
import { AlertCircle, CircleCheck } from "lucide-react";
import Loader from "../loader";

const FormSchema = z.object({
  feedback: z
    .string()
    .min(10, {
      message: "La opinión debe contener al menos 10 caracteres.",
    })
    .max(400, {
      message: "La opinión no puede superar los 400 caracteres.",
    }),
});

export default function FeedbackForm({
  programId,
  userEmail,
  jwt,
}: {
  programId: string;
  userEmail: string;
  jwt: string;
}) {
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [isSuccess, setIsSuccess] = useState<boolean>(false);
  const [errors, setErrors] = useState<string[]>([]);
  const router = useRouter();

  const form = useForm<z.infer<typeof FormSchema>>({
    resolver: zodResolver(FormSchema),
  });

  async function onSubmit(data: z.infer<typeof FormSchema>) {
    setIsLoading(true);
    const { feedback } = data;

    const response = await submitProgramFeedback(
      feedback,
      userEmail,
      programId,
      jwt
    );

    if (response.error) {
      setIsLoading(false);
      setErrors([
        "Ocurrió un error, recuerda que solo puedes enviar una opinión por programa.",
      ]);
      return;
    }

    setIsSuccess(true);
    setIsLoading(false);

    setTimeout(() => {
      router.push(PROGRAMS_PAGE_ROUTE);
    }, 3000);
  }

  return (
    <>
      {isLoading && <Loader></Loader>}

      {isSuccess ? (
        <div className="flex flex-col gap-4 my-4">
          <Alert variant={"success"}>
            <CircleCheck className="h-4 w-4"></CircleCheck>
            <AlertTitle>Éxito</AlertTitle>
            <AlertDescription>
              Tu opinión ha sido enviada correctamente.
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
        <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-6">
          <FormField
            control={form.control}
            name="feedback"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Opinión</FormLabel>
                <FormControl>
                  <Textarea
                    placeholder="Cuéntanos que te parece este programa educativo."
                    className="resize-none"
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
          <Button type="submit">Enviar</Button>
        </form>
      </Form>
    </>
  );
}
