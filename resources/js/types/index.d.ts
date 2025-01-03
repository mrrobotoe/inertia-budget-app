import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    avatar: string;
}

export interface Budgets {
    data: Budget[];
}

export interface Budget {
    data: {
        type: string;
        attributes: {
            createdAt: string;
            updatedAt: string;
            name: string;
        };
        id: number;
        uuid: string;
    }
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    data: {
        token: string;
        budgets: Budget[];
    };
    ziggy: Config & { location: string };
};
