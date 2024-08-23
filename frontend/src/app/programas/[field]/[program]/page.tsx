import ProgramPage from "@/components/ui/programs/program-page";
import ProgramPageSkeleton from "@/components/ui/skeletons/program-page-skeleton";
import { Suspense } from "react";

export default function ProgramsPage({
  params,
}: {
  params: { program: string };
}) {
  return (
    <div className="flex flex-col gap-10">
      <Suspense fallback={<ProgramPageSkeleton></ProgramPageSkeleton>}>
        <ProgramPage programName={params.program}></ProgramPage>
      </Suspense>
    </div>
  );
}
