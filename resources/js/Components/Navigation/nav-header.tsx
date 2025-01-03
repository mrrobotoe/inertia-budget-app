'use client';

import {
    ChevronsUpDown,
    CircleDollarSign,
    HandCoins,
    Plus,
    WalletCards
} from 'lucide-react';

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import {
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    useSidebar,
} from '@/Components/ui/sidebar';
import { Budget } from '@/types';
import { Link } from '@inertiajs/react';
import React from 'react';

export default function NavHeader({ budgets }: { budgets: Budget[] }) {
    const { isMobile } = useSidebar();
    const [activeBudget, setActiveBudget] = React.useState(budgets[0]);
    return (
        <SidebarMenu>
            <SidebarMenuItem>
                <DropdownMenu>
                    <DropdownMenuTrigger asChild>
                        <SidebarMenuButton
                            size="lg"
                            className="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
                        >
                            <div className="flex aspect-square size-8 items-center justify-center rounded-lg bg-blue-600 bg-sidebar-primary text-sidebar-primary-foreground">
                                {/*<activeTeam.logo className="size-4" />*/}
                                <HandCoins className="size-4" />
                            </div>
                            <div className="grid flex-1 text-left text-sm leading-tight">
                                <span className="truncate font-semibold">
                                    {activeBudget.name}
                                </span>
                                <span className="truncate text-xs">
                                    Budget Information
                                </span>
                            </div>
                            <ChevronsUpDown className="ml-auto" />
                        </SidebarMenuButton>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent
                        className="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg"
                        align="start"
                        side={isMobile ? 'bottom' : 'right'}
                        sideOffset={4}
                    >
                        <DropdownMenuLabel className="text-xs text-muted-foreground">
                            Budgets
                        </DropdownMenuLabel>
                        {budgets.map((budget, index) => (
                            <Link
                                key={budget.name}
                                className="w-full"
                                href={route('budgets.show', budget.id)}
                            >
                                <DropdownMenuItem
                                    onClick={() => setActiveBudget(budget)}
                                    className="gap-2 p-2"
                                >
                                    <div className="flex size-6 items-center justify-center rounded-sm border">
                                        {/*<team.logo className="size-4 shrink-0" />*/}
                                        <CircleDollarSign className="size-5 shrink-0" />
                                    </div>
                                    {budget.name}
                                    {/*<DropdownMenuShortcut>*/}
                                    {/*    ⌘{index + 1}*/}
                                    {/*</DropdownMenuShortcut>*/}
                                </DropdownMenuItem>
                            </Link>
                        ))}
                        <Link className="w-full" href={route('budgets')}>
                            <DropdownMenuItem className="gap-2 p-2">
                                <div className="flex size-6 items-center justify-center rounded-sm border">
                                    {/*<team.logo className="size-4 shrink-0" />*/}
                                    <WalletCards className="size-5 shrink-0" />
                                </div>
                                All Budgets
                                {/*<DropdownMenuShortcut>*/}
                                {/*    ⌘{index + 1}*/}
                                {/*</DropdownMenuShortcut>*/}
                            </DropdownMenuItem>
                        </Link>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem className="gap-2 p-2">
                            <div className="flex size-6 items-center justify-center rounded-md border bg-background">
                                <Plus className="size-4" />
                            </div>
                            <div className="font-medium text-muted-foreground">
                                Add budget
                            </div>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </SidebarMenuItem>
        </SidebarMenu>
    );
}
