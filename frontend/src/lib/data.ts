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

export async function fetchProgramsByField(fieldId: string) {
  try {
    unstable_noStore();
    const res = await fetch(
      `${process.env.NEXT_PUBLIC_BACKEND_URL}/programs/field/${fieldId}`
    );
    const data = await res.json();
    return data;
  } catch (err) {
    console.error("Failed to fetch programs:", err);
  }
}

export async function fetchProgramsByFieldName(fieldName: string) {
  try {
    unstable_noStore();
    const res = await fetch(
      `${process.env.NEXT_PUBLIC_BACKEND_URL}/programs/field/name/${fieldName}`
    );
    const data = await res.json();
    return data;
  } catch (err) {
    console.error("Failed to fetch programs:", err);
  }
}

export async function fetchProgramByName(name: string) {
  try {
    unstable_noStore();
    const res = await fetch(
      `${process.env.NEXT_PUBLIC_BACKEND_URL}/programs/name/${name}`
    );
    const data = await res.json();
    return data;
  } catch (err) {
    console.error("Failed to fetch programs:", err);
  }
}

export async function registerUser(
  name: string,
  email: string,
  password: string,
  address: string
) {
  try {
    const res = await fetch(
      `${process.env.NEXT_PUBLIC_BACKEND_URL}/users/register`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          name,
          email,
          password,
          address,
        }),
      }
    );
    const data = await res.json();
    return data;
  } catch (err) {
    console.error("Failed to register user:", err);
  }
}
