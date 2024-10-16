<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VillainRequest;
use App\Models\Skill;
use App\Models\Villain;
use App\Models\Universe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VillainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villain = Villain::where('user_id', Auth::id())->first();
        $skills = $villain->skills;
        $services = $villain->services;

        return view('admin.villains.index', compact('villain', 'skills', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Devi essere autenticato per creare un Villain.');
        }

        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {
            return redirect()->route('admin.villains.index')->with('error', 'Sei già un Villain.');
        }

        $universes = Universe::all();
        $skills = Skill::all();

        return view('admin.villains.create', compact('universes', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VillainRequest $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Devi essere autenticato per creare un Villain.');
        }

        $userVillain = Villain::where('user_id', Auth::id())->first();
        if ($userVillain) {
            return redirect()->route('admin.villains.index')->with('error', 'Sei già un Villain.');
        }

        Log::info('Dati ricevuti dal form:', $request->all()); // Logga i dati del form

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }


        // Crea il Villain
        $new_villain = new Villain;
        $new_villain->slug = Helper::generateSlug($data['name'], Villain::class);
        $new_villain->user_id = Auth::id();

        $new_villain->fill($data);

        $new_villain->save();

        return redirect()->route('admin.villains.index')->with('success', 'Benvenuto ora sei un vero Villain!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Villain $villain)
    {
        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {
            $universes = Universe::all();
            $skills = Skill::all();

            return view('admin.villains.edit', compact('villain', 'universes', 'skills'));
        } else {
            return redirect()->route('admin.villains.index')->with('error', 'Non puoi modificare questo Villain');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VillainRequest $request, Villain $villain)
    {
        $data = $request->all();

        if ($data['name'] === $villain->name) {
            $data['slug'] = $villain->slug;
        } else {
            $data['slug'] = Helper::generateSlug($data['name'], Villain::class);
        }

        $villain->update($data);

        return redirect()->route('admin.villains.index', $villain)->with('edited', 'Edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Villain $villain)
    {
        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {
            $villain->delete();

            return redirect()->route('admin.villains.create')->with('success', 'Villan eliminato con successo!');
        } else {
            return redirect()->route('admin.villains.index')->with('error', 'Non puoi eliminare questo Villain.');
        }
    }
}
