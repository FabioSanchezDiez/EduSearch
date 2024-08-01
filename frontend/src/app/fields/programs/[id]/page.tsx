import Programs from "@/components/ui/programs/programs";
import GenericSkeleton from "@/components/ui/skeletons/generic-skeleton";
import { Suspense } from "react";

export default function ProgramsPage({ params }: { params: { id: string } }) {
  return (
    <div className="flex flex-col gap-6">
      <h1 className="text-2xl font-semibold">Programas Académicos</h1>
      <Suspense fallback={<GenericSkeleton></GenericSkeleton>}>
        <Programs id={params.id}></Programs>
      </Suspense>
    </div>
  );
}
