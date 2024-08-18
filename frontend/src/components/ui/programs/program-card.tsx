"use client";

import { ProgramItem } from "@/types/definitions";
import { Card, CardContent, CardFooter } from "../card";
import { usePathname, useRouter } from "next/navigation";
import { formatString } from "@/lib/utils";
import { Button } from "../button";
import { PROGRAMS_PAGE_ROUTE } from "@/lib/routes";

export default function ProgramCard({
  id,
  name,
  description,
  tag,
}: ProgramItem) {
  const paths = usePathname();
  const fieldName = paths.split("/").filter((path) => path)[1];
  const { push } = useRouter();

  return (
    <Card
      key={id}
      className="cursor-pointer hover:bg-slate-200 dark:hover:bg-zinc-900 flex flex-col justify-end"
      onClick={() =>
        push(`${PROGRAMS_PAGE_ROUTE}/${fieldName}/${formatString(name)}`)
      }
    >
      <CardContent className="flex flex-col gap-2 aspect-square items-center justify-center p-4">
        <p className="text-2xl font-semibold text-center">{name}</p>
        <p className="text-center">{description}</p>
      </CardContent>
      <CardFooter className="p-0">
        <Button variant="secondary" size="card">
          Ver Programa
        </Button>
      </CardFooter>
    </Card>
  );
}
