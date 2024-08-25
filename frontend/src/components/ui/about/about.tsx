import Link from "next/link";
import { Button } from "../button";
import { Separator } from "../separator";
import { LOGIN_PAGE_ROUTE, PROGRAMS_PAGE_ROUTE } from "@/lib/routes";

export default function About() {
  return (
    <>
      <section className="flex flex-col gap-4">
        <h1 className="text-4xl font-bold leading-[115%]">
          <span className="text-primary">¿Qué es </span>
          EduSearch?
        </h1>
        <div className="flex flex-col gap-3">
          <p className="sm:text-xl leading-normal">
            EduSearch es una plataforma de código abierto diseñada para ayudar a
            los estudiantes en la búsqueda de su camino educativo deseado
            ofreciéndole las oportunidades de las que dispone.
          </p>
          <p className="sm:text-xl leading-normal">
            También, ayuda a los estudiantes que están cursando algún tipo de
            formación mostrando cómo reforzar y aprovechar al máximo ciertas
            asignaturas con ejemplos de otros centros y experiencias de otras
            personas. Además facilita las empresas que ofrecen prácticas en su
            sector.
          </p>
        </div>
      </section>
      <Separator></Separator>
      <section className="flex flex-col gap-4">
        <h2 className="text-4xl font-bold leading-[115%]">
          <span className="text-primary">¿Cómo funciona </span>la plataforma?
        </h2>
        <div className="flex flex-col gap-3">
          <p className="sm:text-xl leading-normal">
            En la sección de{" "}
            <Link href={PROGRAMS_PAGE_ROUTE}>
              <span className="font-semibold hover:text-primary">
                Programas Educativos
              </span>
            </Link>{" "}
            podrás explorar una variedad de opciones, navegando y filtrando por
            familias profesionales.
          </p>
          <p className="sm:text-xl leading-normal">
            Una vez que encuentres el programa educativo que te interesa,
            tendrás acceso a toda la información relevante, como los requisitos
            académicos, las asignaturas, las instituciones que lo ofrecen y las
            opiniones de otros usuarios.
          </p>
          <p className="sm:text-xl leading-normal">
            Para compartir tu opinión sobre los programas educativos que hayas
            cursado, necesitarás{" "}
            <Link href={LOGIN_PAGE_ROUTE}>
              <span className="font-semibold hover:text-primary">
                Iniciar Sesión
              </span>
            </Link>{" "}
            con tu cuenta. En tu área personal, podrás ver el programa educativo
            que estás estudiando actualmente y las empresas que ofrecen
            prácticas en tu sector.
          </p>
        </div>
      </section>
      <Separator></Separator>
      <section className="flex flex-col gap-4">
        <h3 className="text-4xl font-bold leading-[115%]">
          <span className="text-primary">¿Quién impulsa </span>este proyecto?
        </h3>
        <div className="flex flex-col gap-3">
          <p className="sm:text-xl leading-normal">
            Este proyecto está impulsado por el programa de becas
            <span className="font-bold"> Aircury&#39;s Summer of Code</span>,
            que selecciona las mejores propuestas de código abierto relacionadas
            con la educación o sectores de beneficio social, proporcionando
            apoyo económico y mentoría para su desarrollo.
          </p>
          <a
            href="https://docs.google.com/document/d/1o6dLPNADMn-h3vkXfUIeB30-4ZDuPXKVnK4wTwQlx_o/edit"
            target="_blank"
            rel="noopener noreferrer"
            className="w-12"
          >
            <Button variant={"secondary"}>
              Más información acerca del programa
            </Button>
          </a>
        </div>
      </section>
    </>
  );
}
