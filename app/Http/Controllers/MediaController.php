<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MediaController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $type, $mediaId = null)
    {
        $types = ['television', 'short_video', 'radio', 'podcast', 'audiobook', 'exclusive'];
        $selectedType = in_array($type, $types) ? $type : 'television';

        // Validar contraseña para exclusivos
        if ($selectedType === 'exclusive') {
            $password = $request->query('password');
            if ($password !== 'reencuentro2024') {
                return redirect('/');
            }
        }

        $mediasQuery = Media::with('category')
            ->where('type', $selectedType)
            ->latest('publication_date');

        $medias = $mediasQuery->get();
        $mediaList = $medias->all();

        // Buscar el id solicitado en la lista de medias de ese tipo
        $selectedMediaId = null;
        if ($mediaId) {
            $found = collect($mediaList)->firstWhere('id', (int)$mediaId);
            $selectedMediaId = $found ? $found->id : null;
        } else {
            $selectedMediaId = count($mediaList) > 0 ? $mediaList[0]->id : null;
        }

        $selectedMediaId = $selectedMediaId ?? null;
        return Inertia::render('multimedia/Catalog', [
            'medias' => $medias,
            'selectedType' => $selectedType,
            'selectedMediaId' => $selectedMediaId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'file_url' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'cover_image_url' => 'nullable|string',
            'tags' => 'nullable',
        ]);
        $validated['user_id'] = Auth::id() ?? 1;
        // Si no hay cover y el file_url es de YouTube, generar cover automáticamente
        if (empty($validated['cover_image_url']) && !empty($validated['file_url']) && strpos($validated['file_url'], 'youtu') !== false) {
            $youtubeId = $this->extractYoutubeId($validated['file_url']);
            if ($youtubeId) {
                $validated['cover_image_url'] = "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";
            }
        }
        $media = Media::create($validated);
        return redirect()->route('admin.medias', ['type' => $media->type])->with('success', 'Media creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'file_url' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'cover_image_url' => 'nullable|string',
            'tags' => 'nullable',
        ]);
        $validated['user_id'] = Auth::id() ?? 1;
        $media->update($validated);
        return redirect()->route('admin.medias', ['type' => $media->type])->with('success', 'Media actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->route('admin.medias', ['type' => $media->type])->with('success', 'Media eliminada exitosamente.');
    }

    /**
     * Sumar un like a la media.
     */
    public function like(Media $media)
    {
        $media->increment('likes_count');
        return response()->json(['likes_count' => $media->likes_count]);
    }

    /**
     * Quitar un like a la media.
     */
    public function unlike(Media $media)
    {
        if ($media->likes_count > 0) {
            $media->decrement('likes_count');
        }
        return response()->json(['likes_count' => $media->likes_count]);
    }

    /**
     * Sumar una vista a la media.
     */
    public function addView(Media $media)
    {
        $media->increment('views_count');
        return response()->json(['views_count' => $media->views_count]);
    }

    /**
     * Mostrar el listado de medias para el admin filtradas por tipo.
     */
    public function adminIndex($type = 'television')
    {
        // Traducción de tipos en español a los valores de la base de datos
        $typeMap = [
            'television' => 'television',
            'radio' => 'radio',
            'audiolibros' => 'audiobook',
            'exclusivos' => 'exclusive',
            'cortos' => 'short_video',
            'podcast' => 'podcast',
        ];

        $dbType = $typeMap[$type] ?? $type;

        $medias = Media::with('category')
            ->where('type', $dbType)
            ->latest('created_at')
            ->get();

        $categories = Category::where('type', 'media')->get();

        return Inertia::render('admin/multimedia/MediaManagement', [
            'medias' => $medias,
            'selectedType' => $type,
            'categories' => $categories,
        ]);
    }

    /**
     * Extrae el ID de un video de YouTube desde una URL.
     */
    private function extractYoutubeId($url)
    {
        $videoId = null;
        if (strpos($url, 'youtu') === false) {
            return null;
        }
        // Para youtube.com/watch?v=ID
        if (preg_match('/youtube\.com\/.*[?&]v=([^&]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }
        // Para youtu.be/ID
        elseif (preg_match('/youtu\.be\/([^?&]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }
        return $videoId;
    }
}
