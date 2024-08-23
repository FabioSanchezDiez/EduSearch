import MyProgram from "@/components/ui/dashboard/my-program";
import DashboardPageSkeleton from "@/components/ui/skeletons/dashboard-page-skeleton";
import { Suspense } from "react";

export default function Dashboard() {
  return (
    <>
      <h1 className="text-4xl font-bold leading-[115%]">Área Personal</h1>
      <section className="my-6">
        <Suspense fallback={<DashboardPageSkeleton></DashboardPageSkeleton>}>
          <MyProgram></MyProgram>
        </Suspense>
      </section>
    </>
  );
}
