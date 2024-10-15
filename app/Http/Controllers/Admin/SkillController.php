<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SkillsRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::orderBy('name')->get();

        return view('admin.skills.index', compact('skills'));
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
    public function store(SkillsRequest $request)
    {
        $exists = Skill::where('name', $request->name)->first();
        if ($exists == null) {

            $data = $request->all();
            $new_skill = new Skill();
            $new_skill->fill($data);
            $new_skill->save();

            return redirect()->route('admin.skills.index')->with('success', 'Skill creata con successo!');
        } else {

            return redirect()->route('admin.skills.index')->with('error', 'Skill già presente nel database!');
        }
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
    public function update(SkillsRequest $request, Skill $skill)
    {
        $exists = Skill::where('name', $request->name)->first();
        if ($exists == null) {
            $data = $request->all();
            $skill->update($data);

            return redirect()->route('admin.skills.index')->with('success', 'Skill aggiornata con successo!');
        } else {
            return redirect()->route('admin.skills.index')->with('error', 'Skill già presente nel database!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill eliminata con successo!');
    }
}
