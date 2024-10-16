<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Villain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {

            $averageRating = Rating::whereIn('id', $userVillain->ratings()->pluck('rating_id'))->avg('value');

            $ratingsPerVillain = Villain::where('user_id', Auth::id())->with('ratings')->get();

            return view('admin.ratings.index', compact('averageRating', 'ratingsPerVillain'));
        } else {
            return redirect()->route('admin.villains.index');
        }

        // Aggiungere ogni utente e il voto dato
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
