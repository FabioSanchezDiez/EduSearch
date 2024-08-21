import React from "react";
import { ModeToggle } from "../mode-toggle";
import Link from "next/link";
import Image from "next/image";
import Navlinks from "./navlinks";

export default function Navbar() {
  return (
    <header>
      <nav className="flex items-center justify-center flex-col md:flex-row md:gap-8 lg:gap-12 gap-4 p-6 shadow-lg dark:shadow-none bg-gray-200 dark:bg-zinc-900">
        <Link href={"/"}>
          <Image
            src="/img/EduSearchLogo.png"
            alt="logo"
            width={80}
            height={60}
            priority={true}
          />
        </Link>
        <Navlinks></Navlinks>
        <ModeToggle></ModeToggle>
      </nav>
    </header>
  );
}
