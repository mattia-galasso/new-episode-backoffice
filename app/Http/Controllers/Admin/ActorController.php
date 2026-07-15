<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\TvSeries;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actors = Actor::orderBy('name')->get();

        return view('actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('actors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newActor = new Actor();

        $newActor->name = $data['name'];
        $newActor->birth_date = $data['birth_date'];

        /* PHOTO */
        if ($request->hasFile('photo')) {
            $newActor->photo = Storage::putFile('actors', $data['photo']);
        }

        $newActor->save();

        return redirect()->route('actors.show', $newActor);
    }

    /**
     * Display the specified resource.
     */
    public function show(Actor $actor)
    {
        return view('actors.show', compact('actor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        return view('actors.edit', compact('actor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor $actor)
    {
        $data = $request->except(['photo']);

        $actor->update($data);

        /* PHOTO */
        if ($request->hasFile('photo')) {

            if ($actor->photo) {
                Storage::delete($actor->photo);
            }

            $actor->photo = Storage::putFile('actors', $request->file('photo'));

            $actor->save();
        }

        return redirect()->route('actors.show', $actor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        /* PHOTO */
        if ($actor->photo) {
            Storage::delete($actor->photo);
        }

        $actor->tvSeries()->detach();

        $actor->delete();

        return redirect()->route('actors.index');
    }

    /**
     * Controller per API gestione cast.
     */
    public function search(Request $request, TvSeries $tvseries)
    {
        if (!$request->filled('name')) {
            return [];
        }

        return Actor::where('name', 'like', '%' . $request->name . '%')
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'photo',
            ]);
    }
}
