<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
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
                ->orderByPivot('created_at', 'desc')->paginate(25)->onEachSide(0);

            foreach ($ratings as $rating) {
                $rating->pivot->formatted_created_at = \Carbon\Carbon::parse($rating->pivot->created_at)->format('d/m/Y');
                $rating->pivot->mobile_formatted_created_at = \Carbon\Carbon::parse($rating->pivot->created_at)->format('d/m/y');
                $rating->pivot->stars = Helper::iconifyRating($rating->value);
            }

            $columns = [
                ['label' => 'Costumer Name', 'field' => 'pivot->full_name'],
                ['label' => 'Rating', 'field' => 'value'],
                ['label' => 'Date', 'field' => 'pivot->formatted_created_at'],
            ];

            if ($ratings->count()) {
                $ratings_counts = $villain->ratings()->select('value', DB::raw('count(*) as total'))
                    ->groupBy('value')->pluck('total', 'value');

                for ($i = 1; $i <= 5; $i++) {
                    if (!isset($ratings_counts[$i])) {
                        $ratings_counts[$i] = 0;
                    }
                }

                $average_rating = DB::table('rating_villain')
                    ->join('ratings', 'rating_villain.rating_id', '=', 'ratings.id')
                    ->where('rating_villain.villain_id', $villain->id)
                    ->select(DB::raw('AVG(ratings.value) as average_rating'))
                    ->value('average_rating');
            } else {
                for ($i = 1; $i <= 5; $i++) {
                    $ratings_counts[$i] = 0;
                }

                $average_rating = 0;
            }

            $average_rating_icons = Helper::iconifyRating($average_rating);

            return view('admin.ratings.index', compact('ratings', 'columns', 'ratings_counts', 'average_rating', 'average_rating_icons'));
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

            if ($rating) {
                $rating->pivot->formatted_created_at = \Carbon\Carbon::parse($rating->pivot->created_at)->format('d/m/Y');
            }
        } else {
            return redirect()->route('admin.ratings.index');
        }

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
}
