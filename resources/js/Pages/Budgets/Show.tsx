import { Button } from '@/Components/ui/button';
import { SidebarTrigger } from '@/Components/ui/sidebar';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Budget } from '@/types';
import { Plus } from 'lucide-react';

export default function Show({ budget }: { budget: Budget }) {

    return (
        <AuthenticatedLayout
            header={
                <div className="flex gap-2">
                    <SidebarTrigger className="-ml-1" />
                    <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        {budget.data.attributes.name}
                    </h2>
                </div>
            }
        >
            <div className="flex w-full gap-4 border-b border-gray-200 px-3 py-2">
                <Button variant="ghost" size="sm">
                    <Plus /> Category group
                </Button>
            </div>

            <div className="flex w-full gap-4 border-b border-gray-200 px-6 py-3">
                <h1 className="text-xs uppercase">Category</h1>
            </div>
            <div className="divide-y divide-gray-200">
                <div className="bg-slate-50 px-6 py-2">
                    <h1>Bills</h1>
                </div>
                <div className="bg-slate-50 px-6 py-2">
                    <h1>Entertainment</h1>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
