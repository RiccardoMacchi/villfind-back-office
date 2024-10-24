<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VillainRequest;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Villain;
use App\Models\Universe;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VillainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {
            $villain = Villain::where('user_id', Auth::id())->first();
            $average_rating = Rating::whereIn('id', $villain->ratings()->pluck('rating_id'))->avg('value');
            $average_rating_icons = Helper::iconifyRating($average_rating);
            $user = Auth::user();
            $userEmail = $user->email;

            return view('admin.villains.index', compact('villain', 'average_rating', 'average_rating_icons', 'userEmail'));
        } else {
            return redirect()->route('admin.villains.create')->with('error', 'Devi prima essere un Villain');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        var_dump(Auth::id());
        $data['slug'] = Helper::generateSlug($data['name'], Villain::class);
        $data['user_id'] =  Auth::id();

        $new_villain = Villain::create($data);

        if (array_key_exists('skills', $data)) {
            $new_villain->skills()->sync($request->input('skills'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Villain $villain) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Villain $villain)
    {
        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {
            if ($villain->user_id == Auth::id()) {
                $universes = Universe::orderBy('name')->get();
                $services = Service::orderBy('name')->get();
                $skills = Skill::orderBy('name')->get();

                return view('admin.villains.edit', compact('villain', 'universes', 'services', 'skills'));
            } else {
                return redirect()->route('admin.villains.index')->with('error', 'Non puoi modificare questo Villain');
            }
        }

        return redirect()->route('admin.villains.index');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(VillainRequest $request, Villain $villain)
    {
        $data = $request->all();

        $data['slug'] = Helper::generateSlug($data['name'], Villain::class);
        $data['user_id'] =  Auth::id();

        if ($request->hasFile('image') || $request->input('image_delete')) {
            if ($villain->image) {
                Storage::delete($villain->image);
            }

            if ($request->hasFile('image')) {
                $data['image'] = Storage::disk('public')->put('uploads/images', $request->file('image'));
                $data['image'] = asset('storage/' . $data['image']);
            } else {
                $data['image'] = null;
            }
        }

        if ($request->hasFile('cv') || $request->input('cv_delete')) {
            if ($villain->cv) {
                Storage::delete($villain->cv);
            }

            if ($request->hasFile('cv')) {
                $data['cv'] = Storage::disk('public')->put('uploads/cvs', $request->file('cv'));
                $data['cv'] = asset('storage/' . $data['cv']);
            } else {
                $data['cv'] = null;
            }
        }

        if ($data['phone']) {
            $data['phone'] = $data['country_code'] ? Helper::formatInternationalPhone($data['country_code'], $data['phone']) : null;
        }

        $villain->update($data);

        if (array_key_exists('services', $data)) {
            $villain->services()->sync($request->input('services'));
        } else {
            $villain->services()->detach();
        }

        if (array_key_exists('skills', $data)) {
            $villain->skills()->sync($request->input('skills'));
        } else {
            $villain->skills()->detach();
        }

        return redirect()->route('admin.villains.index', $villain);
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
