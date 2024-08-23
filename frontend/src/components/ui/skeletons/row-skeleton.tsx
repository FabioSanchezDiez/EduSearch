export default function RowSkeleton({ length }: { length: number }) {
  return (
    <section className="flex gap-4 w-full max-w-md">
      {Array.from({ length: length }, (_, i) => i + 1).map((i) => (
        <div
          className="w-full h-60 rounded-xl bg-slate-200 dark:bg-zinc-900 animate-pulse"
          key={i}
        ></div>
      ))}
    </section>
  );
}
