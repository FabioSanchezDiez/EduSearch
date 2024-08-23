import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from "@/components/ui/carousel";

import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "../badge";

import { fetchEnterpriseInstitutionsByProgram } from "@/lib/data";
import { Institution } from "@/types/definitions";

export default async function InstitutionsEnterpriseComponent({
  id,
}: {
  id: string;
}) {
  const enterpriseInstitutions: Institution[] =
    await fetchEnterpriseInstitutionsByProgram(id);
  return (
    <>
      {enterpriseInstitutions.length >= 1 ? (
        <Carousel className="w-full max-w-screen-2xl">
          <CarouselContent>
            {enterpriseInstitutions.map((institution: Institution) => (
              <CarouselItem
                key={institution.name}
                className="basis-1/2 sm:basis-1/4"
              >
                <div className="p-1">
                  <Card>
                    <CardContent className="flex flex-col gap-4 aspect-square items-center justify-center p-6 text-center">
                      <p className="font-semibold">{institution.name}</p>
                      <p>{institution.description}</p>
                      <Badge variant={"secondary"}>
                        {institution.province}
                      </Badge>
                      <div>
                        <span>Actualizado por última vez:</span>
                        <Badge variant={"outline"}>
                          {institution.lastUpdate.toString()}
                        </Badge>
                      </div>
                    </CardContent>
                  </Card>
                </div>
              </CarouselItem>
            ))}
          </CarouselContent>
          {enterpriseInstitutions.length > 2 && (
            <>
              <CarouselPrevious />
              <CarouselNext />
            </>
          )}
        </Carousel>
      ) : (
        <p>
          Todavía no hemos encontrado empresas que ofrezcan prácticas
          relacionadas con el programa educativo que estudias actualmente,
          inténtelo más adelante.
        </p>
      )}
    </>
  );
}
