"use client";

import { Button } from "@/components/ui/button";
import { HOME_PAGE_ROUTE } from "@/lib/routes";
import Link from "next/link";

export default function Error() {
  return (
    <div className="container mx-auto mt-16 text-center flex flex-col gap-4 items-center">
      <h1 className="text-4xl font-bold">
        Algo salió <span className="text-primary">mal</span>
      </h1>
      <p className="sm:text-xl leading-normal">
        Ocurrió un error inesperado, por favor, inténtelo de nuevo más tarde.
      </p>
      <Link href={HOME_PAGE_ROUTE} className="w-18">
        <Button variant={"secondary"}>Volver al inicio</Button>
      </Link>
    </div>
  );
}
