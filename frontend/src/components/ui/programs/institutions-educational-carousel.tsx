import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from "@/components/ui/carousel";

import { Card, CardContent } from "@/components/ui/card";

import { fetchEducationalInstitutionsByProgram } from "@/lib/data";
import { Institution } from "@/types/definitions";
import { Badge } from "../badge";

export default async function InstitutionsEducationalCarousel({
  id,
}: {
  id: string;
}) {
  const educationalInstitutions = await fetchEducationalInstitutionsByProgram(
    id
  );

  return (
    <>
      {educationalInstitutions.length >= 1 ? (
        <Carousel className="w-full max-w-md">
          <CarouselContent>
            {educationalInstitutions.map((institution: Institution) => (
              <CarouselItem key={institution.name} className="basis-1/2">
                <div className="p-1">
                  <Card>
                    <CardContent className="flex flex-col gap-2 aspect-square items-center justify-center p-6 text-center">
                      <p className="font-semibold">{institution.name}</p>
                      <p>{institution.description}</p>
                      <Badge variant={"secondary"}>
                        {institution.province}
                      </Badge>
                    </CardContent>
                  </Card>
                </div>
              </CarouselItem>
            ))}
          </CarouselContent>
          {educationalInstitutions.length > 2 && (
            <>
              <CarouselPrevious />
              <CarouselNext />
            </>
          )}
        </Carousel>
      ) : (
        <p>
          Haz click en el botón de Consultar en la sección de Información
          Adicional para obtener información acerca de las instituciones que
          ofrezcen este programa.
        </p>
      )}
    </>
  );
}
