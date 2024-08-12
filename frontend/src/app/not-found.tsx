import { Button } from "@/components/ui/button";
import { HOME_PAGE_ROUTE } from "@/lib/routes";
import Link from "next/link";

export default function NotFound() {
  return (
    <div className="container mx-auto mt-16 text-center flex flex-col gap-4 items-center">
      <h1 className="text-4xl font-bold">
        Ruta <span className="text-primary">no encontrada</span>
      </h1>
      <p className="sm:text-xl leading-normal">
        La ruta a la cual estás intentando acceder no existe.
      </p>
      <Link href={HOME_PAGE_ROUTE} className="w-18">
        <Button variant={"secondary"}>Volver al inicio</Button>
      </Link>
    </div>
  );
}
