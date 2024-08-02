import Fields from "@/components/ui/programs/fields";
import GenericSkeleton from "@/components/ui/skeletons/generic-skeleton";
import { Suspense } from "react";

export default function FieldsPage() {
  return (
    <div className="flex flex-col gap-6">
      <h1 className="text-2xl font-semibold">
        Encuentra programas educativos filtrando por familias profesionales
      </h1>
      <Suspense fallback={<GenericSkeleton></GenericSkeleton>}>
        <Fields></Fields>
      </Suspense>
    </div>
  );
}
