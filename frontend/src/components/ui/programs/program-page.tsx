import { fetchProgramByName, fetchSubjectsByProgram } from "@/lib/data";
import { Program, Subject } from "@/types/definitions";
import { Button } from "../button";

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
      <h1 className="text-2xl font-semibold">{renderField(program?.name)}</h1>
      <section className="flex flex-col gap-4">
        <div>
          <h2 className="text-xl">Descripción</h2>
          <p>{renderField(program?.description)}</p>
        </div>
        <div>
          <h2 className="text-xl">Requisitos Académicos</h2>
          <p>{renderField(program?.priorEducation)}</p>
        </div>
        <div>
          <h2 className="text-xl">Asignaturas</h2>
          {subjects.length >= 1 &&
            subjects.map((subject: Subject) => (
              <p key={subject.id}>{subject.name}</p>
            ))}
        </div>
        <div>
          <h2 className="text-xl">Información Adicional</h2>
          {program?.additionalInformation ? (
            <a href={program.additionalInformation} target="_blank">
              <Button variant={"secondary"} className="mt-1">
                Consultar
              </Button>
            </a>
          ) : (
            <p>No se han encontrado datos</p>
          )}
        </div>
      </section>
    </>
  );
}
