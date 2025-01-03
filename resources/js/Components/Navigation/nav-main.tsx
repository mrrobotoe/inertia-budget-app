import {
    SidebarGroup,
    SidebarGroupContent,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/Components/ui/sidebar';
import { Link } from '@inertiajs/react';

export default function NavMain({ showSidebar }: { showSidebar: boolean }) {
    return (
        <SidebarGroup>
            <SidebarGroupContent>
                <SidebarMenu>
                    {showSidebar && (
                        <>
                            <SidebarMenuItem>
                                <SidebarMenuButton
                                    asChild
                                    isActive={route()
                                        .current()
                                        ?.includes('budgets.show')}
                                >
                                    <Link
                                        href={route(
                                            'budgets.show',
                                            route().params.budget,
                                        )}
                                    >
                                        Budget
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>

                            <SidebarMenuItem>
                                <SidebarMenuButton asChild isActive={false}>
                                    <Link
                                        href={route(
                                            'budgets.reflect',
                                            route().params.budget,
                                        )}
                                    >
                                        Reflect
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        </>
                    )}
                </SidebarMenu>
            </SidebarGroupContent>
        </SidebarGroup>
    );
}
