"use client";

import { Field } from "@/types/definitions";
import { Card, CardContent } from "../card";
import Image from "next/image";
import { useRouter } from "next/navigation";
import { formatString } from "@/lib/utils";

export default function FieldCard({ id, name, description, image }: Field) {
  const { push } = useRouter();

  return (
    <Card
      key={id}
      className="cursor-pointer hover:bg-slate-200 dark:hover:bg-zinc-900"
      onClick={() => push(`/fields/${formatString(name)}`)}
    >
      <CardContent className="flex flex-col gap-2 aspect-square items-center justify-center p-6">
        <Image
          className="dark:invert"
          src={image}
          alt="Disciplina Académica"
          width={140}
          height={140}
        ></Image>
        <p className="text-2xl font-semibold text-center">{name}</p>
        <p className="text-center">{description}</p>
      </CardContent>
    </Card>
  );
}
