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

class VillainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        $villain = Villain::where('user_id', Auth::id())->first();
        return view('admin.villains.index', compact('villain'));
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
    public function store(VillainRequest $request)
    {

        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {
            return redirect()->route('admin.villains.index')->with('error', 'Sei già un Villain.');
        }

        $data = $request->all();

        if(array_key_exists('image', $data)){
            $image = Storage::put('uploads', $data['image']);
        }

        $data['image'] = $image;

        // Crea il Villain
        $new_villain = new Villain;
        var_dump($new_villain);
        $new_villain->slug = Helper::generateSlug($data['name'], Villain::class);
        $new_villain->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('villains', 'public');
            $new_villain->image = $imagePath;
        }

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
    public function edit(string $id)
    {
        $villain = Villain::find($id);
        $universes = Universe::all();
        $skills = Skill::all();

        return view('admin.villains.edit', compact('villain', 'universes', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Villain $villain)
    {
        $data = $request->all();
        $villain = Villain::find($id);

        if($data['name'] === $villain->name){
            $data['slug'] = $villain->slug;
        }else{
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
