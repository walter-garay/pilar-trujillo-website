<?php

namespace App\Http\Controllers;

use App\Models\Media;
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
        ]);
        Media::create($validated);
        return redirect()->route('admin.medias')->with('success', 'Media creada exitosamente.');
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
        ]);
        $media->update($validated);
        return redirect()->route('admin.medias')->with('success', 'Media actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->route('admin.medias')->with('success', 'Media eliminada exitosamente.');
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
     * Mostrar el listado de medias para el admin.
     */
    public function adminIndex()
    {
        $medias = Media::with('category')->latest('publication_date')->get();
        return Inertia::render('admin/multimedia/Management', [
            'medias' => $medias,
        ]);
    }
}
