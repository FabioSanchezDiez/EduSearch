import type { Metadata } from "next";
import { Inter } from "next/font/google";
import { ThemeProvider } from "@/components/providers/theme-provider";
import "./globals.css";
import { SiteFooter } from "@/components/ui/site-footer";
import Navbar from "@/components/ui/navigation/navbar";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "EduSearch",
  description:
    "Designed to help students find their ideal educational paths and support them on their journey.",
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
          <Navbar></Navbar>
          {children}
          <SiteFooter></SiteFooter>
        </ThemeProvider>
      </body>
    </html>
  );
}
