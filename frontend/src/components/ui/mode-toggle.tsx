"use client";

import * as React from "react";
import { Moon, Sun } from "lucide-react";
import { useTheme } from "next-themes";
import { useEffect, useState } from "react";

export function ModeToggle() {
  const [mounted, setMounted] = useState(false);
  const { setTheme, resolvedTheme } = useTheme();

  useEffect(() => setMounted(true), []);

  if (!mounted) return <Sun className="w-5 h-6"></Sun>;

  if (resolvedTheme === "dark") {
    return (
      <Sun
        className="w-5 h-6 cursor-pointer"
        onClick={() => {
          setTheme("light");
        }}
      />
    );
  }

  if (resolvedTheme === "light") {
    return (
      <Moon
        className="w-5 h-6 cursor-pointer"
        onClick={() => {
          setTheme("dark");
        }}
      />
    );
  }
}
