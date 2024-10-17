<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Villain;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;
use App\Models\SponsorshipVillain;

class SponsorshipVillainController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $userVillain = Villain::where('user_id', Auth::id())->first();

        if (!$userVillain) {
            return redirect()->back()->with('error', 'Nessun villain trovato per questo utente.');
        }

        $sponsorshipDetails = $userVillain->sponsorships()->get();
        var_dump($sponsorshipDetails);

        return view('admin.sponsorship.index', compact('userVillain', 'sponsorshipDetails'));
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
        //
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
