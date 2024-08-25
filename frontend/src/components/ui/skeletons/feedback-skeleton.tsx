export default function FeedbackSkeleton({ length }: { length: number }) {
  return (
    <section className="flex flex-col gap-4 w-full">
      {Array.from({ length: length }, (_, i) => i + 1).map((i) => (
        <div
          className="w-full h-20 rounded-xl bg-slate-200 dark:bg-zinc-900 animate-pulse"
          key={i}
        ></div>
      ))}
    </section>
  );
}
