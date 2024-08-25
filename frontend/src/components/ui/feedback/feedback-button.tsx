"use client";

import {
  AlertDialog,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import FeedbackForm from "./feedback-form";

export default function FeedbackButton({
  programId,
  userEmail,
  jwt,
}: {
  programId: string;
  userEmail: string;
  jwt: string;
}) {
  return (
    <>
      <div className="flex flex-col gap-2 text-center">
        <AlertDialog>
          <AlertDialogTrigger className="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
            Opinar sobre este programa
          </AlertDialogTrigger>
          <AlertDialogContent>
            <div className="flex justify-between">
              <div>
                <AlertDialogTitle>Escribe tu opinión</AlertDialogTitle>
                <AlertDialogDescription>
                  Trata de ser respetuoso y evita palabras malsonantes.
                </AlertDialogDescription>
              </div>
              <AlertDialogCancel>Cerrar</AlertDialogCancel>
            </div>
            <FeedbackForm
              programId={programId}
              userEmail={userEmail}
              jwt={jwt}
            ></FeedbackForm>
          </AlertDialogContent>
        </AlertDialog>
      </div>
    </>
  );
}
