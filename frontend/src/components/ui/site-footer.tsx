import { Button } from "./button";

export function SiteFooter() {
  return (
    <footer className="bg-gray-200 dark:bg-zinc-900 p-5 sticky top-[100vh] mt-16 flex flex-col justify-center items-center">
      <p className="text-center font-medium">EduSearch 2024-2025 &#169;</p>
      <div className="flex justify-center items-center">
        <a
          href="https://github.com/FabioSanchezDiez/EduSearch"
          target="_blank"
          rel="noopener noreferrer"
        >
          <Button variant={"navigation"}>Enlace al repositorio</Button>
        </a>
      </div>
    </footer>
  );
}
