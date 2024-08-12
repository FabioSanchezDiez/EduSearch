import { fetchProgramByName, fetchSubjectsByProgram } from "@/lib/data";
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

export default async function ProgramPage({
  programName,
}: {
  programName: string;
}) {
  const program: Program = await fetchProgramByName(programName);
  const subjects: Subject[] = await fetchSubjectsByProgram(program?.id);

  const renderField = (
    field: any,
    defaultMessage: string = "No se han encontrado datos"
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
          <div>
            <h2 className="text-xl font-medium">Información Adicional</h2>
            {program?.additionalInformation ? (
              <a href={program.additionalInformation} target="_blank">
                <Button variant={"secondary"} className="mt-2">
                  Consultar
                </Button>
              </a>
            ) : (
              <p>No se han encontrado datos</p>
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
                    <p className="text-lg">No se han encontrado datos</p>
                  )}
                </div>
              </AccordionContent>
            </AccordionItem>
          </Accordion>
        </section>
      </section>
    </>
  );
}
