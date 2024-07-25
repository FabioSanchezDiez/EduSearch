import React from "react";
import { Button } from "../button";
import Link from "next/link";
import {
  ABOUT_PAGE_ROUTE,
  HOME_PAGE_ROUTE,
  LOGIN_PAGE_ROUTE,
  REGISTER_PAGE_ROUTE,
} from "@/lib/routes";

export default function Navlinks() {
  return (
    <>
      <Link href={HOME_PAGE_ROUTE}>
        <Button variant={"navigation"}>Inicio</Button>
      </Link>
      <Link href={ABOUT_PAGE_ROUTE}>
        <Button variant={"navigation"}>Sobre el proyecto</Button>
      </Link>
      <Link href={LOGIN_PAGE_ROUTE}>
        <Button variant={"navigation"}>Iniciar Sesión</Button>
      </Link>
      <Link href={REGISTER_PAGE_ROUTE}>
        <Button variant={"navigation"}>Registrarse</Button>
      </Link>
    </>
  );
}
