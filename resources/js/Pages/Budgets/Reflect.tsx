import { SidebarTrigger } from '@/Components/ui/sidebar';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
export default function Reflect() {
    return (
        <AuthenticatedLayout
            showSidebar={true}
            header={
                <div className="flex items-center gap-2">
                    <SidebarTrigger className="-ml-1" />
                    <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        Reflect
                    </h2>
                </div>
            }
        ></AuthenticatedLayout>
    );
}
