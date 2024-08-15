import { authOptions } from "@/lib/configs/auth/authOption";
import { fetchProgramByUser } from "@/lib/data";
import { Program } from "@/types/definitions";
import { getServerSession } from "next-auth";

export default async function MyProgram() {
  const session = await getServerSession(authOptions);
  const program: Program = await fetchProgramByUser(
    session?.user?.email!,
    session?.user.token!
  );
  return (
    <>
      <h2 className="text-3xl font-bold leading-[115%]">
        Bienvenido de nuevo,{" "}
        <span className="text-primary">{session?.user.name}</span>
      </h2>
      <section>{program.name ? <p>Esta</p> : <p>No esta</p>}</section>
    </>
  );
}
