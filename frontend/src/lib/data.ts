import { unstable_noStore } from "next/cache";

export async function fetchFields() {
  try {
    unstable_noStore();
    const res = await fetch(`${process.env.NEXT_PUBLIC_BACKEND_URL}/fields`);
    const data = await res.json();
    return data;
  } catch (err) {
    console.error("Failed to fetch fields:", err);
  }
}
