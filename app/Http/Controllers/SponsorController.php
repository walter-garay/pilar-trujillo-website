<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
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
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'social_media_urls' => 'nullable',
            'media_url' => 'nullable|string|max:255',
            'website_url' => 'nullable|string|max:255',
            'promotion_start' => 'nullable|date',
            'promotion_end' => 'nullable|date',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('sponsors', 'public');
            $validated['logo_url'] = $path;
        }

        Sponsor::create($validated);

        return redirect()->route('admin.sponsors')->with('success', 'Auspiciador creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'social_media_urls' => 'nullable',
            'media_url' => 'nullable|string|max:255',
            'website_url' => 'nullable|string|max:255',
            'promotion_start' => 'nullable|date',
            'promotion_end' => 'nullable|date',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('sponsors', 'public');
            $validated['logo_url'] = $path;
        }

        $sponsor->update($validated);

        return redirect()->route('admin.sponsors')->with('success', 'Auspiciador actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();

        // Redirigir al administrador a la lista de auspiciadores
        return redirect()->route('admin.sponsors')->with('success', 'Auspiciador eliminado exitosamente.');
    }

    public function adminIndex()
    {
        $sponsors = Sponsor::all();
        return inertia('admin/sponsors/Management', [
            'sponsors' => $sponsors,
        ]);
    }
}
