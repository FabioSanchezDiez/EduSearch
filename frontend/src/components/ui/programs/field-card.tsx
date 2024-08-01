"use client";

import { Field } from "@/types/definitions";
import { Card, CardContent } from "../card";
import Image from "next/image";

export default function FieldCard({ id, name, description, image }: Field) {
  return (
    <Card
      key={id}
      className="cursor-pointer hover:bg-slate-200 dark:hover:bg-zinc-900"
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
