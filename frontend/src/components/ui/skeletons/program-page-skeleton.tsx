import FeedbackSkeleton from "./feedback-skeleton";
import RowSkeleton from "./row-skeleton";

export default function ProgramPageSkeleton() {
  return (
    <>
      <section className="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full">
        <div className="w-full h-80 rounded-xl bg-slate-200 dark:bg-zinc-900 animate-pulse"></div>
        <div className="w-full h-56 rounded-xl bg-slate-200 dark:bg-zinc-900 animate-pulse"></div>
      </section>
      <RowSkeleton length={2}></RowSkeleton>
      <FeedbackSkeleton length={3}></FeedbackSkeleton>
    </>
  );
}
