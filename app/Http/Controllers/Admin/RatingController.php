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

            // recupero nomi e contenuto delle review
            $ratingsDetails = \DB::table('rating_villain')
                ->where('villain_id', $userVillain->id)
                ->select('full_name', 'content', 'rating_id')
                ->get();


            return view('admin.ratings.index', compact('ratingsDetails'));
            
        } else {
            return redirect()->route('admin.villains.index');
        }
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
    public function show(Rating $rating)
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

    public function statistics(Rating $rating)
    {
        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {

            // recupero i ratings da inserire nel grafico
            $ratingsCount = \DB::table('rating_villain')
            ->where('villain_id', $userVillain->id)
            ->select('rating_id', \DB::raw('count(*) as total'))
            ->groupBy('rating_id')
            ->pluck('total', 'rating_id');

            $ratingsData = [
                '1_star' => $ratingsCount[1] ?? 0,
                '2_stars' => $ratingsCount[2] ?? 0,
                '3_stars' => $ratingsCount[3] ?? 0,
                '4_stars' => $ratingsCount[4] ?? 0,
                '5_stars' => $ratingsCount[5] ?? 0
            ];

            // recupero la media dei voti
            $averageRating = Rating::whereIn('id', $userVillain->ratings()->pluck('rating_id'))->avg('value');

            return view('admin.ratings.statistics', compact('ratingsCount', 'ratingsData', 'averageRating'));
            
        } else {
            return redirect()->route('admin.villains.index');
        }
    }


}
