<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Villain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villain = Villain::where('user_id', Auth::id())->first();

        if ($villain) {
            $ratings = $villain->ratings()->withPivot('full_name', 'content', 'created_at')
                ->orderByPivot('created_at', 'desc')->paginate(25);

            $columns = [
                ['label' => 'Costumer Name', 'field' => 'pivot->full_name'],
                ['label' => 'Rating', 'field' => 'value'],
                ['label' => 'Content', 'field' => 'pivot->content'],
                ['label' => 'Date', 'field' => 'pivot->created_at'],
            ];

            return view('admin.ratings.index', compact('ratings', 'columns'));
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
    public function show(string $review_id)
    {
        $villain = Villain::where('user_id', Auth::id())->first();

        if ($villain) {
            $rating = $villain->ratings()->wherePivot('id', $review_id)
                ->withPivot('full_name', 'content', 'created_at')->first();
        } else {
            return redirect()->route('admin.ratings.index');
        }

        // if (!$villain) {
        //     return redirect()->route('admin.ratings.index')->with('error', 'Villain non trovato.',);
        // }

        // // $rating = $villain->ratings()->where('rating_villain.rating_id', $ratingId)->first();
        // $rating = $villain->ratings()->whereIn('rating_villain.id', [$ratingId])->first();
        // $userVillain = Villain::where('user_id', Auth::id())->first();

        // if (!$rating) {
        //     return redirect()->route('admin.ratings.index')->with('error', 'Rating non trovato.');
        // }

        return view('admin.ratings.show', compact('rating'));
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
            $ratingsCount = DB::table('rating_villain')
                ->where('villain_id', $userVillain->id)
                ->select('rating_id', DB::raw('count(*) as total'))
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
