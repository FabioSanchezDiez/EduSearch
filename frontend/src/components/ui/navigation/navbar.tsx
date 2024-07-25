import React from "react";
import { ModeToggle } from "../mode-toggle";
import Link from "next/link";
import Image from "next/image";

export default function Navbar() {
  return (
    <header>
      <nav className="flex items-center justify-center flex-col md:flex-row md:gap-8 lg:gap-12 gap-4 p-6 shadow-xl bg-background">
        <Link href={"/"}>
          <Image
            src="/img/EduSearchLogo.png"
            alt="logo"
            width={140}
            height={60}
            priority={true}
          />
        </Link>

        <ModeToggle></ModeToggle>
      </nav>
    </header>
  );
}
