import type { Metadata } from "next";
import { Inter } from "next/font/google";
import { ThemeProvider } from "@/components/providers/theme-provider";
import "./globals.css";
import { SiteFooter } from "@/components/ui/site-footer";
import Navbar from "@/components/ui/navigation/navbar";
import { SessionAuthProvider } from "@/components/providers/session-provider";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "EduSearch",
  description:
    "EduSearch, la plataforma para encontrar tu camino educativo y recibir apoyo en tu trayectoria.",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body className={`${inter.className} min-h-screen`}>
        <ThemeProvider
          attribute="class"
          defaultTheme="system"
          enableSystem
          disableTransitionOnChange
        >
          <SessionAuthProvider>
            <Navbar></Navbar>
            {children}
            <SiteFooter></SiteFooter>
          </SessionAuthProvider>
        </ThemeProvider>
      </body>
    </html>
  );
}
