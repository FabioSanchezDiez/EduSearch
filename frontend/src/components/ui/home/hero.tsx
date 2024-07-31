import Link from "next/link";
import Image from "next/image";
import { Button } from "../button";

export default function Hero() {
  return (
    <section className="container px-16 grid lg:grid-cols-2">
      <div className="flex flex-col justify-center items-start">
        <h1 className="text-4xl sm:text-5xl font-bold text-primary leading-[115%] mb-8">
          Encuentra tus opciones
          <span className="text-black dark:text-white block">
            y refuerza tu camino
          </span>
        </h1>
        <p className="sm:text-xl leading-normal mb-8">
          Bienvenido a{" "}
          <span className="text-primary font-semibold">EduSearch</span>, una
          plataforma de código abierto que te permite encontrar opciones
          educativas para dar el próximo paso en tu carrera y te brinda ayuda en
          la misma a través de opiniones.
        </p>
        <Link href={"/accounts/login"}>
          <Button>Iniciar Sesión</Button>
        </Link>
      </div>
      <div className="hidden lg:block mx-auto mt-8 sm:mt-0">
        <Image
          className="w-[150px] h-[150px] sm:w-[250px] sm:h-[250px]"
          src={"/img/EduSearchLogo.png"}
          alt="logo"
          width={250}
          height={250}
        ></Image>
      </div>
    </section>
  );
}
