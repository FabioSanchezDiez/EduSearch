import { fetchProgramsByField } from "@/lib/data";
import { Program } from "@/types/definitions";
import ProgramCard from "./program-card";

export default async function Programs({ id }: { id: string }) {
  const programs = await fetchProgramsByField(id);

  return (
    <section className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      {programs.length >= 1 &&
        programs.map((program: Program) => (
          <ProgramCard
            key={program.id}
            id={program.id}
            name={program.name}
            description={program.description}
          ></ProgramCard>
        ))}
    </section>
  );
}
