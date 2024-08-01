export default function GenericSkeleton() {
  return (
    <section className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      {Array.from({ length: 6 }, (_, i) => i + 1).map((i) => (
        <div
          className="w-full h-96 rounded-xl bg-slate-200 dark:bg-zinc-900 animate-pulse"
          key={i}
        ></div>
      ))}
    </section>
  );
}
