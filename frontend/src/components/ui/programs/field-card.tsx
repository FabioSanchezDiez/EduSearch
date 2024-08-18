"use client";

import { Field } from "@/types/definitions";
import { Card, CardContent, CardFooter } from "../card";
import Image from "next/image";
import { useRouter } from "next/navigation";
import { formatString } from "@/lib/utils";
import { Button } from "../button";
import { PROGRAMS_PAGE_ROUTE } from "@/lib/routes";

export default function FieldCard({ id, name, description, image }: Field) {
  const { push } = useRouter();

  return (
    <Card
      key={id}
      className="cursor-pointer hover:bg-slate-200 dark:hover:bg-zinc-900 flex flex-col justify-end"
      onClick={() => push(`${PROGRAMS_PAGE_ROUTE}/${formatString(name)}`)}
    >
      <CardContent className="flex flex-col gap-2 aspect-square items-center justify-center p-4">
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
      <CardFooter className="p-0">
        <Button variant="secondary" size="card">
          Ver Programas
        </Button>
      </CardFooter>
    </Card>
  );
}
