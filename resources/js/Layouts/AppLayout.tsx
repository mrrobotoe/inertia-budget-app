import NavBar from '@/Components/NavBar';
import { PropsWithChildren } from 'react';
export default function App({ children }: PropsWithChildren) {
    return (
        <>
            <NavBar />
            <main className="mt-6 w-full flex-1 overflow-hidden bg-white px-6 py-4 dark:bg-gray-800">
                {children}
            </main>
        </>
    );
}
