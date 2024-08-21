import { fetchProgramsByFieldName } from "@/lib/data";
import { ProgramItem } from "@/types/definitions";
import ProgramCard from "./program-card";

export default async function Programs({ field }: { field: string }) {
  const programs = await fetchProgramsByFieldName(field);

  return (
    <section className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      {programs.length >= 1 &&
        programs.map((program: ProgramItem) => (
          <ProgramCard
            key={program.id}
            id={program.id}
            name={program.name}
            description={program.description}
            tag={program.tag}
            type={program.type}
          ></ProgramCard>
        ))}
    </section>
  );
}
