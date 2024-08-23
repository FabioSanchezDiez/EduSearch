import ProgramPage from "@/components/ui/programs/program-page";
import GenericSkeleton from "@/components/ui/skeletons/generic-skeleton";
import { Suspense } from "react";

export default function ProgramsPage({
  params,
}: {
  params: { program: string };
}) {
  return (
    <div className="flex flex-col gap-10">
      <Suspense fallback={<GenericSkeleton></GenericSkeleton>}>
        <ProgramPage programName={params.program}></ProgramPage>
      </Suspense>
    </div>
  );
}
