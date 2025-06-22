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

export function getYoutubeEmbedUrl(url: string): string {
    // Expresión regular para obtener el ID de YouTube de diferentes formatos de URL
    const youtubeUrlPattern = /(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/)([a-zA-Z0-9_-]+)|youtu\.be\/([a-zA-Z0-9_-]+))/;

    // Intentamos hacer match con la URL
    const match = url.match(youtubeUrlPattern);

    // Si encontramos un ID de video en la URL
    if (match) {
        // Si encontramos un ID de video en la URL
        const videoId = match[1] || match[2];
        return `https://www.youtube.com/embed/${videoId}`;
    }

    // Si no es una URL de YouTube válida, devolvemos la URL original
    return url;
}
