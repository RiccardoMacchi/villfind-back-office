<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Villain;
use App\Models\Universe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VillainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villains = Villain::where('user_id', Auth::id())->get();;
        dd('villains');
        return view('admin.villains.index', compact('villains'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
    public function store(Request $request)
    {

        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {
            return redirect()->route('admin.villains.index')->with('error', 'Sei già un Villain.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:villains,slug',
            'email_contact' => 'nullable|email|max:255',
            'image' => 'nullable|image',
            'phone' => 'nullable|string|max:20',
            'universe_id' => 'required|exists:universes,id'
        ]);

        // Salvataggio dell'immagine se presente
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('villains', 'public');
        }

        // Crea il Villain
        Villain::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'email_contact' => $request->input('email'),
            'phone' => $request->input('phone'),
            'universe_id' => $request->input('universe_id'),
            'image' => $imagePath
        ]);

        return redirect()->route('admin.villains.index')->with('success', 'Benvenuto ora sei un vero Villain!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
