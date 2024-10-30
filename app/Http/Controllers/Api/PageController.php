<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MessageRequest;
use App\Models\Message;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Universe;
use App\Models\Villain;
use App\Models\Rating;
use App\Models\Sponsorship;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        // if (isset($_GET['search'])) {
        //     $villains = Villain::where('name', 'LIKE', '%' . $_GET['search'] . '%')->orderBy('name')->with('skills', 'universe', 'services', 'ratings', 'sponsorships')->paginate(12);
        // } else {
        $villains = Villain::orderBy('name')->with('skills', 'universe', 'services', 'ratings', 'sponsorships')->paginate(12);
        // }

        if ($villains) {
            $success = true;
            foreach ($villains as $villain) {

                if ($villain->image) {
                    $villain->image = asset($villain->image);
                } else {
                    // ??????????????????????????????????????????????
                    $villain->image = Storage::url('placeholder_img.jpg');
                }
            }
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'villains'));
    }

    public function allSkills()
    {
        $skills = Skill::orderBy('name')->get();

        if ($skills) {
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'skills'));
    }

    public function allServices()
    {
        $services = Service::orderBy('name')->get();

        if ($services) {
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'services'));
    }

    public function allUniverses()
    {
        $universes = Universe::orderBy('name')->get();

        if ($universes) {
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'universes'));
    }

    public function maxPossibleReviews()
    {
        $max_possible_reviews = DB::table('rating_villain')
            ->select(DB::raw('COUNT(*) as rating_count'))
            ->groupBy('villain_id')
            ->orderByDesc('rating_count')
            ->limit(1)
            ->value('rating_count');

        return response()->json(compact('max_possible_reviews'));
    }

    public function maxRatingValue()
    {
        $max_rating_value = Rating::max('value');

        return response()->json(compact('max_rating_value'));
    }

    // Send only sponsored villains
    public function villainsSponsored()
    {

        $villains = Villain::whereHas('sponsorships', function ($query) {
            $query->where('expiration_date', '>', Carbon::now());
        })->with(['ratings', 'services'])->get();

        if ($villains->isNotEmpty()) {
            $success = true;
        } else {
            $success = false;
            $villains = [];
        }

        return response()->json(compact('success', 'villains'));
    }

    // Send villains filtered based by request filters
    public function listByFilters(Request $request)
    {
        $query = Villain::with('ratings', 'universe', 'skills', 'services', 'sponsorships')
            ->leftJoin('sponsorship_villain', 'villains.id', '=', 'sponsorship_villain.villain_id')
            ->select('villains.*')
            ->addSelect(DB::raw('MAX(CASE WHEN sponsorship_villain.expiration_date > NOW() THEN 1 ELSE 0 END) as active_sponsorship'))
            ->groupBy('villains.id')
            ->orderByDesc('active_sponsorship')
            ->orderBy('name', 'asc');

        if ($request->has('universe_id')) {
            $universe_id = $request->input('universe_id');

            $query->where('universe_id', $universe_id);
        }

        if ($request->has('skill_id')) {
            $skill_id = $request->input('skill_id');

            $query->whereHas('skills', function ($q) use ($skill_id) {
                $q->where('id', $skill_id);
            });
        }

        if ($request->has('service_id')) {
            $service_id = $request->input('service_id');

            $query->whereHas('services', function ($q) use ($service_id) {
                $q->where('id', $service_id);
            });
        }

        if ($request->has('rating')) {
            $avg_rating = $request->input('rating');

            $query->leftJoin('rating_villain', 'villains.id', '=', 'rating_villain.villain_id')
                ->leftJoin('ratings', 'rating_villain.rating_id', '=', 'ratings.id')
                ->addSelect(DB::raw('AVG(ratings.value) as weighted_average_rating'))
                ->groupBy('villains.id')
                ->having('weighted_average_rating', '>=', $avg_rating);
        }

        if ($request->has('min_reviews')) {
            $min_reviews = $request->input('min_reviews');

            $query->whereHas('ratings', function ($q) use ($min_reviews) {
                $q->select('villain_id')
                    ->groupBy('villain_id')
                    ->havingRaw('COUNT(*) >= ?', [$min_reviews]);
            });
        }

        $villains = $query->get();

        $maxReviews = Villain::withCount('ratings')
            ->orderBy('ratings_count', 'desc')
            ->first()
            ->ratings_count ?? 0;


        $success = $villains->isNotEmpty();

        return response()->json(compact('success', 'villains'));
    }

    // Send single villain data and log view
    public function villainBySlug($slug, Request $request)
    {
        $villain = Villain::where('slug', $slug)->with('skills', 'universe', 'services', 'ratings')->first();

        if ($villain) {
            $success = true;

            $villain->image = $villain->image ? asset($villain->image) : Storage::url('placeholder_img.jpg');

            $visitor_ip = $request->ip();
            $exists = View::where('visitor_ip', $visitor_ip)->where('villain_id', $villain->id)->exists();
            if (!$exists) {
                $view = new View();
                $view->villain_id = $villain->id;
                $view->visitor_ip = $visitor_ip;
                $view->save();
            }
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'villain'));
    }

    // Get and store a message for a villain
    public function storeMessage(Request $request)
    {
        $data = $request->all();

        $new_mess = new Message;

        $new_mess->fill($data);
        $new_mess->save();
        return response()->json(['message' => 'Message saved successfully!', 'data' => $new_mess], 201);
    }

    public function storeRating(Request $request)
    {
        $validated = $request->validate([
            'villain_id' => 'required|exists:villains,id',
            'rating_id' => 'required|exists:ratings,id',
            'full_name' => 'required|string|min:1|max:255',
            'content' => 'nullable|string|max:1000'
        ]);

        $villain = Villain::find($validated['villain_id']);

        $villain->ratings()->attach($validated['rating_id'], [
            'full_name' => $validated['full_name'],
            'content' => $validated['content']
        ]);

        return response()->json(['message' => 'Rating saved successfully!'], 201);
    }
}
