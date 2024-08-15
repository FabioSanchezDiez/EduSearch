import MyProgram from "@/components/ui/dashboard/my-program";
import { Separator } from "@/components/ui/separator";

export default function Dashboard() {
  return (
    <>
      <h1 className="text-4xl font-bold leading-[115%]">Área Personal</h1>
      <section className="my-6">
        <MyProgram></MyProgram>
      </section>
      <Separator></Separator>
    </>
  );
}
