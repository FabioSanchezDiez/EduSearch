import Programs from "@/components/ui/programs/programs";
import GenericSkeleton from "@/components/ui/skeletons/generic-skeleton";
import { Suspense } from "react";

export default function ProgramsPage({
  params,
}: {
  params: { field: string };
}) {
  return (
    <div className="flex flex-col gap-6">
      <Suspense fallback={<GenericSkeleton></GenericSkeleton>}>
        <Programs field={params.field}></Programs>
      </Suspense>
    </div>
  );
}
