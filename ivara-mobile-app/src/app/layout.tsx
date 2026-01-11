import type { Metadata } from "next";
import { Poppins } from "next/font/google";
import "./globals.css";

const poppins = Poppins({
  variable: "--font-poppins",
  subsets: ["latin"],
  weight: ["300", "400", "500", "600", "700", "800"],
});

export const metadata: Metadata = {
  title: "IVARA Mobile",
  description: "Service Marketplace & Management",
};

import { SettingsProvider } from '@/contexts/SettingsContext';
import { ThemeProvider } from '@/contexts/ThemeContext';
import { SearchProvider } from '@/contexts/SearchContext';

import Link from "next/link";
import BottomNav from "@/components/navigation/BottomNav";
import MobileHeader from '@/components/MobileHeader';

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body className={`${poppins.variable} antialiased font-sans`}>
        <ThemeProvider>
          <SettingsProvider>
            <SearchProvider>
              <MobileHeader />
              <div className="pt-16">
                {children}
              </div>
              <BottomNav />
            </SearchProvider>
          </SettingsProvider>
        </ThemeProvider>
      </body>
    </html>
  );
}
