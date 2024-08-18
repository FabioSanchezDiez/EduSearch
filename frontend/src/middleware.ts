export { default } from "next-auth/middleware";

export const config = {
  matcher: [`/area-personal/:path*`],
};
