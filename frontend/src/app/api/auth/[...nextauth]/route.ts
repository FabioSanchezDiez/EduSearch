import { authOptions } from "@/lib/configs/auth/authOption";
import NextAuth from "next-auth";

const handler = NextAuth(authOptions);
export { handler as GET, handler as POST };
