import { fetchFields } from "@/lib/data";
import { Field } from "@/types/definitions";
import { Card, CardContent } from "../card";
import Image from "next/image";

export default async function Fields() {
  const fields = await fetchFields();

  return (
    <section className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      {fields.length >= 1 &&
        fields.map((field: Field) => (
          <Card
            key={field.id}
            className="cursor-pointer hover:bg-slate-200 dark:hover:bg-zinc-900"
          >
            <CardContent className="flex flex-col gap-2 aspect-square items-center justify-center p-6">
              <Image
                className="dark:invert"
                src={field.image}
                alt="Disciplina Académica"
                width={140}
                height={140}
              ></Image>
              <p className="text-2xl font-semibold text-center">{field.name}</p>
              <p className="text-center">{field.description}</p>
            </CardContent>
          </Card>
        ))}
    </section>
  );
}
