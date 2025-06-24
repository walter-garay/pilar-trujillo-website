<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $types = ['television', 'short_video', 'radio', 'podcast', 'audiobook'];
        $selectedType = $request->get('tab', 'television'); // Default a television

        // Validar que el tipo seleccionado sea válido
        if (!in_array($selectedType, $types)) {
            $selectedType = 'television';
        }

        // Obtener todas las medias del tipo seleccionado con paginación
        $medias = Media::with('category')
            ->where('type', $selectedType)
            ->latest('publication_date')
            ->paginate(12);

        return Inertia::render('multimedia/Catalog', [
            'medias' => $medias,
            'selectedType' => $selectedType,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        //
    }
}
