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
        $villain = Villain::where('user_id', Auth::id())->first();

        if (!$villain) {
            return redirect()->back()->with('error', 'Nessun villain trovato per questo utente.');
        }

        $sponsorships = Sponsorship::orderBy('id')->get();

        $orders = $villain->sponsorships()
            ->withPivot('expiration_date', 'purchase_price')
            ->orderBy('pivot_expiration_date', 'desc')
            ->paginate(25);

        $orders->getCollection()->transform(function ($sponsorship) {
            return (object) [
                'name' => $sponsorship->name,
                'expiration_date' => $sponsorship->pivot->expiration_date,
                'purchase_price' => $sponsorship->pivot->purchase_price,
            ];
        });

        $columns = [
            ['label' => 'Plan', 'field' => 'name'],
            ['label' => 'Total', 'field' => 'purchase_price'],
            ['label' => 'Expiration', 'field' => 'expiration_date'],
        ];

        return view('admin.sponsorship.index', compact('sponsorships', 'villain', 'orders', 'columns'));
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

        $last_order = $villain->sponsorships()->orderBy('expiration_date', 'desc')->first();;

        if ($last_order && Carbon::parse($last_order->pivot->expiration_date) > Carbon::now()) {
            $expiration_date = Carbon::parse($last_order->pivot->expiration_date);
        } else {
            $expiration_date = Carbon::now();
        }

        $expiration_date->addHours($sponsorship->hours);

        $villain->sponsorships()->attach($sponsorship->id, ['expiration_date' => $expiration_date, 'purchase_price' => $sponsorship->price]);
        return redirect()->route('admin.sponsorship.index');
    }
}
