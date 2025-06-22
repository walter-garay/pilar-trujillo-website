import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    phone?: string;
    social_media_urls?: Record<string, string>;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface Media {
    id: number;
    title: string;
    description: string;
    file_url: string;
    type: 'television' | 'short_video' | 'radio' | 'podcast' | 'audiobook';
    cover_image_url: string;
    publication_date: string;
    category_id: number;
    user_id: number;
    tags: string; // JSON string
    created_at: string;
    updated_at: string;
    category?: Category; // Optional relationship
}

export interface Category {
    id: number;
    name: string;
    type: 'media' | 'publication';
}

export interface Sponsor {
    id: number;
    name: string;
    logo_url: string;
    description: string;
    email: string;
    phone: string;
    social_media_urls: string; // JSON string
    media_url: string;
    created_at: string;
    updated_at: string;
}
