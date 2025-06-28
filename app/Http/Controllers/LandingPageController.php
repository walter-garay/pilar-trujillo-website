<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        $medias = [
            'television' => Media::with('category')->where('type', 'television')->latest('publication_date')->take(3)->get(),
            'short_video' => Media::with('category')->where('type', 'short_video')->latest('publication_date')->take(3)->get(),
            'podcast' => Media::with('category')->where('type', 'podcast')->latest('publication_date')->take(3)->get(),
            'radio' => Media::with('category')->where('type', 'radio')->latest('publication_date')->take(3)->get(),
            'audiobook' => Media::with('category')->where('type', 'audiobook')->latest('publication_date')->take(3)->get(),
        ];

        $now = now();
        $sponsors = Sponsor::where(function($query) use ($now) {
            $query->whereNull('promotion_start')->orWhere('promotion_start', '<=', $now);
        })
        ->where(function($query) use ($now) {
            $query->whereNull('promotion_end')->orWhere('promotion_end', '>=', $now);
        })
        ->latest()
        ->get();

        // Obtener el usuario administrador (solo datos no sensibles)
        $adminUser = User::where('role', 'admin')
            ->orderBy('created_at', 'asc')
            ->select('name', 'email', 'phone', 'social_media_urls', 'photo_url')
            ->first();

        return Inertia::render('landing/LandingPage', [
            'medias' => $medias,
            'sponsors' => $sponsors,
            'adminUser' => $adminUser,
        ]);
    }

}
