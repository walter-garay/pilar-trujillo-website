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
    photo_url?: string | null;
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
    views_count: number;
    likes_count: number;
    created_at: string;
    updated_at: string;
    category?: Category; // Optional relationship
}

export interface Category {
    id: number;
    name: string;
    type: string;
}

export interface Publication {
    id: number;
    title: string;
    content: string;
    status: string;
    author_id: number;
    category_id: number;
    tags: string;
    references?: string;
    views_count: number;
    created_at: string;
    updated_at: string;
    author?: User | undefined;
    category?: Category | undefined;
    images?: { file_url: string }[];
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
    website_url: string | null;
    promotion_start?: string | null;
    promotion_end?: string | null;
    created_at: string;
    updated_at: string;
}
