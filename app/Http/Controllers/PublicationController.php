<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'content' => 'nullable|string',
            'status' => 'required|in:active,archived',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable',
            'references' => 'nullable',
            'views_count' => 'nullable|integer|min:0',
        ]);

        Publication::create($validated);

        return redirect()->route('admin.publications')->with('success', 'Publicación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|in:active,archived',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable',
            'references' => 'nullable',
            'views_count' => 'nullable|integer|min:0',
        ]);

        $publication->update($validated);

        return redirect()->route('admin.publications')->with('success', 'Publicación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();
        return redirect()->route('admin.publications')->with('success', 'Publicación eliminada exitosamente.');
    }

    public function adminIndex()
    {
        $publications = Publication::with(['author', 'category', 'images'])->get();
        $categories = \App\Models\Category::where('type', 'publication')->get();
        $users = \App\Models\User::all();
        return Inertia::render('admin/publications/PublicationManagment', [
            'publications' => $publications,
            'categories' => $categories,
            'users' => $users,
        ]);
    }
}
