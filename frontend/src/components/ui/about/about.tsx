import { Button } from "../button";
import { Separator } from "../separator";

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
            dependiendo de su localidad y formación previa ofreciéndole las
            oportunidades de las que dispone.
          </p>
          <p className="sm:text-xl leading-normal">
            También, ayuda a los estudiantes que están cursando algún tipo de
            formación mostrando cómo reforzar y aprovechar al máximo ciertas
            asignaturas con ejemplos de otros centros y experiencias de otras
            personas.
          </p>
          <p className="sm:text-xl leading-normal">
            Además facilita las empresas que ofrecen prácticas en su localidad y
            que opina la gente de ellas.
          </p>
        </div>
      </section>
      <Separator></Separator>
      <section className="flex flex-col gap-4">
        <h2 className="text-4xl font-bold leading-[115%]">
          <span className="text-primary">¿Cómo funciona </span>la plataforma?
        </h2>
        <div className="flex flex-col gap-3">
          <p className="sm:text-xl leading-normal">Por completar.</p>
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
