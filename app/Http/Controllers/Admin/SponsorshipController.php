<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsorship;
use App\Models\Villain;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
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
        $sponsorships = Sponsorship::orderBy('id')->get();

        $sponsorshipDetails = $userVillain->sponsorships()->get();
        return view('admin.sponsorship.index', compact('sponsorships', 'userVillain', 'sponsorshipDetails'));
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

    // Sponsorship purchasing
    public function purchaseSponsorship(Sponsorship $sponsorship)
    {
        $villain = Villain::where('user_id', Auth::id())->first();

        $last_expiration_date = $villain->sponsorships()->orderBy('expiration_date', 'desc')->first()->pivot->expiration_date;;

        if (Carbon::parse($last_expiration_date) > Carbon::now()) {
            $expiration_date = Carbon::parse($last_expiration_date);
        } else {
            $expiration_date = Carbon::now();
        }

        $expiration_date->addHours($sponsorship->hours);

        $villain->sponsorships()->attach($sponsorship->id, ['expiration_date' => $expiration_date, 'purchase_price' => $sponsorship->price]);
        return redirect()->route('admin.sponsorship.index');
    }
}
