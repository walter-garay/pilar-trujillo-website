<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Category;
use App\Models\User;
use App\Models\PublicationImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::with(['author', 'category', 'images'])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Category::where('type', 'publication')->get();

        return Inertia::render('publications/Catalog', [
            'publications' => $publications,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'publication')->get();
        return Inertia::render('admin/publications/components/PublicationForm', [
            'categories' => $categories,
            'isEdit' => false,
        ]);
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
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable',
            'references' => 'nullable',
            'views_count' => 'nullable|integer|min:0',
            'images' => 'nullable',
            'images.*' => 'image|max:4096',
        ]);

        $validated['author_id'] = Auth::id();
        $publication = Publication::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('publications', 'public');
                PublicationImage::create([
                    'publication_id' => $publication->id,
                    'file_url' => $path,
                ]);
            }
        }

        return redirect()->route('admin.publications')->with('success', 'Publicación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        $publication->increment('views_count'); // Suma una vista
        $publication->load(['author', 'category', 'images']);
        return Inertia::render('publications/PublicationView', [
            'publication' => $publication,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        $publication->load(['author', 'category', 'images']);
        $categories = Category::where('type', 'publication')->get();
        return Inertia::render('admin/publications/components/PublicationForm', [
            'publication' => $publication,
            'categories' => $categories,
            'isEdit' => true,
        ]);
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
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable',
            'references' => 'nullable',
            'views_count' => 'nullable|integer|min:0',
            'images' => 'nullable',
            'images.*' => 'image|max:4096',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:publication_images,id',
        ]);

        $validated['author_id'] = Auth::id();
        $publication->update($validated);

        // Eliminar imágenes marcadas
        if ($request->filled('delete_images')) {
            foreach ($request->input('delete_images') as $imgId) {
                $img = \App\Models\PublicationImage::find($imgId);
                if ($img && $img->publication_id == $publication->id) {
                    $img->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('publications', 'public');
                PublicationImage::create([
                    'publication_id' => $publication->id,
                    'file_url' => $path,
                ]);
            }
        }

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
        $publications = Publication::with(['author', 'category', 'images'])->orderBy('created_at', 'desc')
        ->get();
        $categories = Category::where('type', 'publication')->get();
        $users = User::all();
        return Inertia::render('admin/publications/PublicationManagment', [
            'publications' => $publications,
            'categories' => $categories,
            'users' => $users,
        ]);
    }
}
