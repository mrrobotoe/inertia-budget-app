import AppLayout from '@/Layouts/AppLayout';
import { Head } from '@inertiajs/react';

export default function About() {
    return (
        <AppLayout>
            <Head title="About" />
            <div className="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
                <h1>About Page</h1>
            </div>
        </AppLayout>
    );
}
