import ProgramsBreadcrumb from "@/components/ui/programs/programs-breadcrumb";

export default function Layout({ children }: { children: React.ReactNode }) {
  return (
    <div className="container mx-auto mt-16">
      <div className="mb-8">
        <ProgramsBreadcrumb></ProgramsBreadcrumb>
      </div>
      {children}
    </div>
  );
}
