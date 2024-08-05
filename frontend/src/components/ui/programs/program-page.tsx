import { fetchProgramByName } from "@/lib/data";
import { Program } from "@/types/definitions";
import { Button } from "../button";

export default async function ProgramPage({
  programName,
}: {
  programName: string;
}) {
  const program: Program = await fetchProgramByName(programName);

  return (
    <>
      <h1 className="text-2xl font-semibold">{program?.name}</h1>
      <section className="flex flex-col gap-4">
        <div>
          <h2 className="text-xl">Descripción</h2>
          <p>{program?.description}</p>
        </div>
        <div>
          <h2 className="text-xl">Requisitos Académicos</h2>
          <p>{program?.priorEducation}</p>
        </div>
        <div>
          <h2 className="text-xl">Información Adicional</h2>
          <a href={program?.additionalInformation} target="_blank">
            <Button variant={"secondary"} className="mt-1">
              Consultar
            </Button>
          </a>
        </div>
      </section>
    </>
  );
}
