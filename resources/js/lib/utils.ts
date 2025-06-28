import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function formatDate(dateString: string | Date | undefined | null): string {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
}

/**
 * Extracts the YouTube video ID from a given URL and returns the embed URL.
 * Supports both standard YouTube URLs and shortened youtu.be URLs.
 * If the URL is invalid or does not contain a valid video ID, the original URL is returned.
 *
 * @param url - The YouTube video URL to process.
 * @returns A string representing the YouTube embed URL or the original URL if no valid ID is found.
 */
export function getYoutubeEmbedUrl(url: string): string {
    let videoId: string | null = null;

    try {
        const parsedUrl = new URL(url);

        if (parsedUrl.hostname.includes('youtube.com') && parsedUrl.searchParams.has('v')) {
            videoId = parsedUrl.searchParams.get('v');
        } else if (parsedUrl.hostname.includes('youtu.be')) {
            videoId = parsedUrl.pathname.split('/')[1];
        }
    } catch (error) {
        console.error('Error processing the YouTube URL:', error);
    }

    console.log("id dev: ", videoId)
    return videoId ? `https://www.youtube.com/embed/${videoId}` : url;
}
