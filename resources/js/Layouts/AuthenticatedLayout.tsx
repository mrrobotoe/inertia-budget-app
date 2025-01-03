import NavBar from '@/Components/NavBar';
import { SidebarInset, SidebarProvider } from '@/Components/ui/sidebar';
import { Head, usePage } from '@inertiajs/react';
import { PropsWithChildren, ReactNode } from 'react';

export default function Authenticated({
    header,
    children,
    showSidebar = true,
}: PropsWithChildren<{ header?: ReactNode; showSidebar?: boolean }>) {
    const user = usePage().props.auth.user;

    return (
        <SidebarProvider>
            <Head title="Budgets" />
            <NavBar showSidebar={showSidebar} />
            <SidebarInset>
                <div className="flex h-full w-full flex-col bg-gray-100 dark:bg-gray-900">
                    {header && (
                        <header className="w-full rounded-t-lg border-b border-b-slate-200 bg-white dark:bg-gray-800">
                            <div className="max-w-7xl px-6 py-2">{header}</div>
                        </header>
                    )}

                    <main className="h-full overflow-y-auto rounded-b-lg bg-white">
                        {children}
                    </main>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
