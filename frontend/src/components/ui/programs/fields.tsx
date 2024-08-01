import { fetchFields } from "@/lib/data";
import { Field } from "@/types/definitions";
import FieldCard from "./field-card";

export default async function Fields() {
  const fields = await fetchFields();

  return (
    <section className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      {fields.length >= 1 &&
        fields.map((field: Field) => (
          <FieldCard
            key={field.id}
            id={field.id}
            name={field.name}
            description={field.description}
            image={field.image}
          ></FieldCard>
        ))}
    </section>
  );
}
