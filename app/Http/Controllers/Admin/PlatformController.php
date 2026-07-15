<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::orderBy('name')->get();

        return view('platforms.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('platforms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newPlatform = new Platform();

        $newPlatform->name = $data['name'];
        $newPlatform->website = $data['website'];

        /* LOGO_IMG */
        if ($request->hasFile('logo_img')) {
            $newPlatform->logo_img = Storage::putFile('platforms', $data['logo_img']);
        }

        $newPlatform->save();

        return redirect()->route('platforms.show', $newPlatform);
    }

    /**
     * Display the specified resource.
     */
    public function show(Platform $platform)
    {
        return view('platforms.show', compact('platform'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platform $platform)
    {
        return view('platforms.edit', compact('platform'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Platform $platform)
    {
        $data = $request->except(['logo_img']);

        $platform->update($data);

        /* LOGO_IMG */
        if ($request->hasFile('logo_img')) {

            if ($platform->logo_img && !str_starts_with($platform->logo_img, 'logo_')) {
                Storage::delete($platform->logo_img);
            }

            $platform->logo_img = Storage::putFile('platforms', $request->file('logo_img'));

            $platform->save();
        }

        return redirect()->route('platforms.show', $platform);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platform $platform)
    {
        /* LOGO_IMG */
        if ($platform->logo_img && !str_starts_with($platform->logo_img, 'logo_')) {
            Storage::delete($platform->logo_img);
        }

        $platform->tvSeries()->detach();

        $platform->delete();

        return redirect()->route('platforms.index');
    }
}
