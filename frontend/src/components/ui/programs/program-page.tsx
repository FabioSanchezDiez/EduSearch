import { fetchProgramByName, fetchSubjectsByProgram } from "@/lib/data";
import { getServerSession } from "next-auth";
import { authOptions } from "@/lib/configs/auth/authOption";
import { Program, Subject } from "@/types/definitions";
import { Button } from "../button";

import { ScrollArea } from "@/components/ui/scroll-area";

import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from "@/components/ui/accordion";

import {
  HoverCard,
  HoverCardContent,
  HoverCardTrigger,
} from "@/components/ui/hover-card";

import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger,
} from "@/components/ui/tooltip";

import EnrollButton from "./enroll-button";
import { InfoIcon } from "lucide-react";
import InstitutionsEducationalCarousel from "./institutions-educational-carousel";
import { Suspense } from "react";
import RowSkeleton from "../skeletons/row-skeleton";

export default async function ProgramPage({
  programName,
}: {
  programName: string;
}) {
  const program: Program = await fetchProgramByName(programName);
  const subjects: Subject[] = await fetchSubjectsByProgram(program?.id);

  const session = await getServerSession(authOptions);
  const renderField = (
    field: any,
    defaultMessage: string = "No se han encontrado datos."
  ) => {
    return field || defaultMessage;
  };

  return (
    <>
      <section className="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <section className="flex flex-col gap-4">
          <h1 className="text-2xl font-semibold">
            {renderField(program?.name)}
          </h1>
          <p className="text-xl">
            En esta página encontrarás toda la información relacionada con el
            programa educativo de{" "}
            <span className="text-primary">{renderField(program?.name)}.</span>{" "}
            Si consideras que falta información importante respecto a este
            programa, ponte en contacto con nosotros.
          </p>
          <div className="grid grid-cols-2">
            <div className="flex flex-col">
              <h2 className="text-xl font-medium">Información Adicional</h2>
              {program?.additionalInformation ? (
                <a
                  href={program.additionalInformation}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="mt-2 w-12"
                >
                  <Button variant={"secondary"}>Consultar</Button>
                </a>
              ) : (
                <p>No se han encontrado datos.</p>
              )}
            </div>
            {session?.user && (
              <EnrollButton programId={program.id}></EnrollButton>
            )}
          </div>
        </section>

        <section className="flex flex-col gap-4">
          <Accordion type="multiple">
            <AccordionItem value="item-1">
              <AccordionTrigger className="text-xl">
                Descripción
              </AccordionTrigger>
              <AccordionContent>
                <p className="text-lg">{renderField(program?.description)}</p>
              </AccordionContent>
            </AccordionItem>
            <AccordionItem value="item-2">
              <AccordionTrigger className="text-xl">
                Requisitos Académicos
              </AccordionTrigger>
              <AccordionContent>
                <p className="text-lg">
                  {renderField(program?.priorEducation)}
                </p>
              </AccordionContent>
            </AccordionItem>
            <AccordionItem value="item-3">
              <AccordionTrigger className="text-xl">
                Asignaturas
              </AccordionTrigger>
              <AccordionContent>
                <div className="flex flex-col gap-3 text-lg">
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
                    <p className="text-lg">
                      Haz click en el botón de Consultar en la sección de{" "}
                      <span className="font-semibold">
                        Información Adicional
                      </span>{" "}
                      para obtener información acerca de las asignaturas de este
                      programa.
                    </p>
                  )}
                </div>
              </AccordionContent>
            </AccordionItem>
          </Accordion>
        </section>
      </section>
      <section className="flex flex-col gap-4">
        <div className="flex gap-2">
          <h3 className="text-2xl font-semibold">
            Instituciones Educativas en las que se imparte
          </h3>
          <TooltipProvider>
            <Tooltip>
              <TooltipTrigger>
                <InfoIcon></InfoIcon>
              </TooltipTrigger>
              <TooltipContent>
                <p>
                  En esta sección solo aparecen algunas de las instituciones que
                  ofrecen este programa. Si deseas encontrar más opciones
                  asegurate de realizar una búsqueda más profunda.
                </p>
              </TooltipContent>
            </Tooltip>
          </TooltipProvider>
        </div>
        <Suspense fallback={<RowSkeleton length={2}></RowSkeleton>}>
          <InstitutionsEducationalCarousel
            id={program?.id}
          ></InstitutionsEducationalCarousel>
        </Suspense>
      </section>
    </>
  );
}
