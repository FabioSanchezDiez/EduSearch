"use client";

import React from "react";
import Autoplay from "embla-carousel-autoplay";
import Image from "next/image";

import { Card, CardContent } from "@/components/ui/card";
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from "@/components/ui/carousel";

const fields = [
  {
    name: "Informática",
    link: "https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Inform%C3%A1tica_-_EduSearch-NO-BG.png?alt=media&token=58c4d331-1500-4df8-8d68-996be82a447e",
  },
  {
    name: "Deporte",
    link: "https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Actividades_F%C3%ADsicas_y_Deportivas_-_EduSearch-NO-BG.png?alt=media&token=45cccef7-2426-4054-82b5-7b6218fb55a2",
  },
  {
    name: "Servicios",
    link: "https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Servicios_Socioculturales_-_EduSearch-NO-BG.png?alt=media&token=0deeadc1-cc93-4c68-b1ed-a50a0b35b05f",
  },
  {
    name: "Sanidad",
    link: "https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Salud_-_EduSearch-NO-BG.png?alt=media&token=e65f3cd0-361f-41ab-806d-c887d26c92c1",
  },
  {
    name: "Audiovisuales",
    link: "https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Imagen_y_Sonido_-_EduSearch-NO-BG.png?alt=media&token=1a8d3e8a-7e82-4c3d-88a0-7f52bd583a6a",
  },
];

export default function FieldsCarousel() {
  const plugin = React.useRef(
    Autoplay({ delay: 2000, stopOnInteraction: true })
  );

  return (
    <section className="container flex flex-col gap-6 px-12">
      <h2 className="font-semibold text-2xl">
        Busca programas educativos por ramas
      </h2>
      <Carousel
        plugins={[plugin.current]}
        onMouseEnter={plugin.current.stop}
        onMouseLeave={plugin.current.reset}
        className="w-full max-w-md"
      >
        <CarouselContent className="-ml-1">
          {fields.map((field) => (
            <CarouselItem key={field.name} className="basis-1/2 sm:basis-1/3">
              <div className="p-1">
                <Card>
                  <CardContent className="flex flex-col gap-1 aspect-square items-center justify-center p-6">
                    <Image
                      className="dark:invert"
                      src={field.link}
                      alt="Disciplina Académica"
                      width={60}
                      height={60}
                    ></Image>
                    <p>{field.name}</p>
                  </CardContent>
                </Card>
              </div>
            </CarouselItem>
          ))}
        </CarouselContent>
        <CarouselPrevious />
        <CarouselNext />
      </Carousel>
    </section>
  );
}
