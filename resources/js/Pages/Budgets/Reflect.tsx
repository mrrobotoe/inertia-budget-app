import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbSeparator,
} from '@/Components/ui/breadcrumb';
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
                        <Breadcrumb>
                            <BreadcrumbList>
                                <BreadcrumbItem>
                                    <BreadcrumbLink
                                        href={route(
                                            'budgets.show',
                                            route().params.budget,
                                        )}
                                    >
                                        <h1>Budget</h1>
                                    </BreadcrumbLink>
                                </BreadcrumbItem>
                                <BreadcrumbSeparator />
                                <BreadcrumbItem>
                                    <BreadcrumbLink
                                        href={route().current()?.split('.')[1]}
                                    >
                                        <h1>Relfect</h1>
                                    </BreadcrumbLink>
                                </BreadcrumbItem>
                            </BreadcrumbList>
                        </Breadcrumb>
                    </h2>
                </div>
            }
        ></AuthenticatedLayout>
    );
}
