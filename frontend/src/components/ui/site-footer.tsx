import { Github } from "lucide-react";
import { Button } from "./button";

export function SiteFooter() {
  return (
    <footer className="bg-gray-200 dark:bg-zinc-900 p-5 sticky top-[100vh] mt-16 flex flex-col justify-center items-center">
      <p className="text-center font-medium">
        EduSearch {new Date().getFullYear()} &#169;
      </p>
      <a
        href="https://github.com/FabioSanchezDiez/EduSearch"
        target="_blank"
        rel="noopener noreferrer"
      >
        <Button variant={"navigation"} className="flex gap-1 items-center">
          Enlace al repositorio <Github className="w-4 h-4"></Github>
        </Button>
      </a>
    </footer>
  );
}
