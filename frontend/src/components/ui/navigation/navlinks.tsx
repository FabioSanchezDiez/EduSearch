"use client";

import React from "react";
import { Button } from "../button";
import Link from "next/link";
import {
  ABOUT_PAGE_ROUTE,
  HOME_PAGE_ROUTE,
  LOGIN_PAGE_ROUTE,
  REGISTER_PAGE_ROUTE,
} from "@/lib/routes";
import { signOut, useSession } from "next-auth/react";
import { LoaderIcon } from "lucide-react";

export default function Navlinks() {
  const { data: session, status } = useSession();

  return (
    <>
      <Link href={HOME_PAGE_ROUTE}>
        <Button variant={"navigation"}>Inicio</Button>
      </Link>
      <Link href={ABOUT_PAGE_ROUTE}>
        <Button variant={"navigation"}>Sobre el proyecto</Button>
      </Link>
      {status === "loading" ? (
        <LoaderIcon></LoaderIcon>
      ) : session?.user ? (
        <Button variant={"navigation"} onClick={() => signOut()}>
          Cerrar Sesión
        </Button>
      ) : (
        <>
          <Link href={LOGIN_PAGE_ROUTE}>
            <Button variant={"navigation"}>Iniciar Sesión</Button>
          </Link>
          <Link href={REGISTER_PAGE_ROUTE}>
            <Button variant={"navigation"}>Registrarse</Button>
          </Link>
        </>
      )}
    </>
  );
}
