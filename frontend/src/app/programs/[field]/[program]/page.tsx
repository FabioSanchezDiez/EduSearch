import GenericSkeleton from "@/components/ui/skeletons/generic-skeleton";
import { Suspense } from "react";

export default function ProgramsPage({
  params,
}: {
  params: { program: string };
}) {
  return (
    <div className="flex flex-col gap-6">
      <h1 className="text-2xl font-semibold">Programa</h1>
      <Suspense fallback={<GenericSkeleton></GenericSkeleton>}>
        <div>{params.program}</div>
      </Suspense>
    </div>
  );
}
