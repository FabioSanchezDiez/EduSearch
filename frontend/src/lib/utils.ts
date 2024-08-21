import { type ClassValue, clsx } from "clsx";
import { twMerge } from "tailwind-merge";

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs));
}

export function formatString(str: string) {
  const accentsMap: { [key: string]: string } = {
    á: "a",
    é: "e",
    í: "i",
    ó: "o",
    ú: "u",
  };

  const normalizeStr = str
    .toLowerCase()
    .replace(/[áéíóú]/g, (match) => accentsMap[match]);

  return encodeURIComponent(
    normalizeStr.replace(/\s+/g, "-").replace(/,/g, "")
  );
}

export function unformatString(str: string) {
  return decodeURIComponent(str)
    .split("-")
    .map((word) => {
      if (word.length === 1) {
        return word;
      } else {
        return word.charAt(0).toUpperCase() + word.slice(1);
      }
    })
    .join(" ");
}
