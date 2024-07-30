import FieldsCarousel from "@/components/ui/home/fields-carousel";
import Hero from "@/components/ui/home/hero";
import { Separator } from "@/components/ui/separator";

export default function Home() {
  return (
    <>
      <main className="mt-24 flex flex-col gap-12">
        <Hero></Hero>
        <Separator></Separator>
        <FieldsCarousel></FieldsCarousel>
      </main>
    </>
  );
}
