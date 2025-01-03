import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
} from '@/Components/ui/sidebar';

import NavHeader from '@/Components/Navigation/nav-header';
import NavMain from '@/Components/Navigation/nav-main';
import { NavUser } from '@/Components/Navigation/nav-user';
import { usePage } from '@inertiajs/react';
export default function NavBar({
    showSidebar = true,
}: {
    showSidebar: boolean;
}) {
    const budgets = usePage().props.data.budgets;
    const user = usePage().props.auth.user;

    return (
        <Sidebar variant="inset">
            <SidebarHeader>
                <NavHeader budgets={budgets} />
            </SidebarHeader>
            <SidebarContent>
                <NavMain showSidebar={showSidebar} />
            </SidebarContent>
            <SidebarFooter>
                <NavUser user={user} />
            </SidebarFooter>
        </Sidebar>
    );
}
