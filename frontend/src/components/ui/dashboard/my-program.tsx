import { authOptions } from "@/lib/configs/auth/authOption";
import { fetchProgramByUser, fetchSubjectsByProgram } from "@/lib/data";
import { Program, Subject } from "@/types/definitions";
import { getServerSession } from "next-auth";

import { ScrollArea } from "@/components/ui/scroll-area";

import { Separator } from "@/components/ui/separator";

import {
  HoverCard,
  HoverCardContent,
  HoverCardTrigger,
} from "@/components/ui/hover-card";
import { Button } from "../button";
import Link from "next/link";
import { PROGRAMS_PAGE_ROUTE } from "@/lib/routes";

export default async function MyProgram() {
  const session = await getServerSession(authOptions);
  const program: Program = await fetchProgramByUser(
    session?.user?.email!,
    session?.user.token!
  );
  const subjects: Subject[] = await fetchSubjectsByProgram(program?.id);

  return (
    <>
      <div className="flex flex-col gap-6">
        <h2 className="text-3xl font-semibold leading-[115%]">
          Bienvenido de nuevo,{" "}
          <span className="text-primary">{session?.user.name}</span>
        </h2>
        <div className="flex flex-col gap-4">
          <h3 className="text-2xl font-medium leading-[115%]">
            Estudiando actualmente:
          </h3>
          <section className="flex flex-col gap-4">
            {program.name ? (
              <>
                <article>
                  <p className="sm:text-xl leading-normal">{program.name}</p>
                </article>
                <Separator></Separator>
                <article className="flex flex-col gap-3 text-lg">
                  <h4 className="text-2xl font-medium leading-[115%]">
                    Asignaturas:
                  </h4>
                  {subjects.length >= 1 ? (
                    subjects.map((subject: Subject) => (
                      <HoverCard key={subject.id}>
                        <HoverCardTrigger className="cursor-pointer underline-offset-4 hover:underline">
                          {subject.name}
                        </HoverCardTrigger>
                        <HoverCardContent asChild>
                          <ScrollArea className="h-[200px] w-96 rounded-md border p-4 text-center">
                            {subject.description}
                          </ScrollArea>
                        </HoverCardContent>
                      </HoverCard>
                    ))
                  ) : (
                    <p className="text-lg">No se han encontrado datos</p>
                  )}
                </article>
                <Separator></Separator>
                <article>
                  <h5 className="text-2xl font-medium leading-[115%]">
                    Empresas del sector:
                  </h5>
                </article>
              </>
            ) : (
              <>
                <p className="sm:text-xl leading-normal">
                  Aún no has elegido el programa educativo que estás cursando
                  actualmente. Por favor, busca tu programa educativo actual y
                  pulsa el botón para seleccionarlo como tu programa.
                </p>
                <Link href={PROGRAMS_PAGE_ROUTE} className="w-18">
                  <Button variant={"secondary"}>Ver programas</Button>
                </Link>
              </>
            )}
          </section>
        </div>
      </div>
    </>
  );
}
