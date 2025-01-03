import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

import { SidebarTrigger } from '@/Components/ui/sidebar';
import { Budgets } from '@/types';
import { Link } from '@inertiajs/react';
export default function Index({ budgets }: { budgets: Budgets }) {
    return (
        <AuthenticatedLayout
            showSidebar={false}
            header={
                <div className="flex items-center gap-2">
                    <SidebarTrigger className="-ml-1" />
                    <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        All Budgets
                    </h2>
                </div>
            }
        >
            <div className="flex h-full w-full gap-3 p-6">
                <ul className="flex w-full flex-row flex-wrap gap-3">
                    {budgets.data.map((budget) => (
                        <Link
                            key={budget.uuid}
                            href={route('budgets.show', budget.id)}
                        >
                            <li
                                id={budget.uuid}
                                className="flex h-min min-w-44 cursor-pointer flex-col items-center rounded-md border border-gray-200 bg-gray-50 p-4 px-4 shadow hover:bg-blue-50 dark:border-gray-700 dark:bg-slate-600 dark:text-white dark:hover:bg-slate-800"
                            >
                                <img
                                    className="h-32 w-32 rounded-full border border-gray-400"
                                    src={
                                        'https://avatar.iran.liara.run/public/9'
                                    }
                                    alt=""
                                />
                                <span className="text-center font-bold">
                                    {budget.attributes.name}
                                </span>
                                <span className="text-center text-sm">
                                    {new Date(
                                        budget.attributes.createdAt,
                                    ).toLocaleDateString('en-US')}
                                </span>
                            </li>
                        </Link>
                    ))}
                </ul>
            </div>
        </AuthenticatedLayout>
    );
}
