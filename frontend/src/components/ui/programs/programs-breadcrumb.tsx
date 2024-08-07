"use client";

import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator,
} from "@/components/ui/breadcrumb";
import { unformatString } from "@/lib/utils";
import Link from "next/link";
import { usePathname } from "next/navigation";

export default function ProgramsBreadcrumb() {
  const paths = usePathname();
  const pathNames = paths.split("/").filter((path) => path);

  return (
    <>
      <Breadcrumb>
        <BreadcrumbList>
          {pathNames.length === 1 ? (
            <BreadcrumbItem>
              <BreadcrumbPage>Familias Profesionales</BreadcrumbPage>
            </BreadcrumbItem>
          ) : pathNames.length === 2 ? (
            <>
              <BreadcrumbItem>
                <BreadcrumbLink asChild>
                  <Link href="/programs">Familias Profesionales</Link>
                </BreadcrumbLink>
              </BreadcrumbItem>
              <BreadcrumbSeparator />
              <BreadcrumbItem>
                <BreadcrumbPage>{unformatString(pathNames[1])}</BreadcrumbPage>
              </BreadcrumbItem>
            </>
          ) : (
            <>
              <BreadcrumbItem>
                <BreadcrumbLink asChild>
                  <Link href="/programs">Familias Profesionales</Link>
                </BreadcrumbLink>
              </BreadcrumbItem>
              <BreadcrumbSeparator />
              <BreadcrumbItem>
                <BreadcrumbLink asChild>
                  <Link href={`/programs/${pathNames[1]}`}>
                    {unformatString(pathNames[1])}
                  </Link>
                </BreadcrumbLink>
              </BreadcrumbItem>
              <BreadcrumbSeparator />
              <BreadcrumbItem>
                <BreadcrumbPage>{unformatString(pathNames[2])}</BreadcrumbPage>
              </BreadcrumbItem>
            </>
          )}
        </BreadcrumbList>
      </Breadcrumb>
    </>
  );
}
