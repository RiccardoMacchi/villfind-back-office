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
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function allRatings()
    {
        $ratings = Rating::select('value')->distinct()->orderBy('value')->get();


        $success = $ratings->isNotEmpty();

        return response()->json(compact('success', 'ratings'));
    }

    public function villainBySlug($slug)
    {
        $villain = Villain::where('slug', $slug)->with('skills', 'universe', 'services', 'ratings')->first();
        if ($villain) {
            $success = true;
            if ($villain->image) {
                $villain->image = asset($villain->image);
            } else {
                $villain->image = Storage::url('placeholder_img.jpg');
            }
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'villain'));
    }

    public function listByUniverse($id)
    {
        $universe = Universe::where('id', $id)->with('villains')->first();
        if ($universe) {
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'universe'));
    }

    public function listBySkill($id)
    {
        $skill = Skill::where('id', $id)->with('villains')->first();
        if ($skill) {
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'skill'));
    }

    public function listByService($id)
    {
        $service = Service::where('id', $id)->with('villains')->first();
        if ($service) {
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'service'));
    }
    public function listByFilters(Request $request)
    {
        $query = Villain::with('ratings', 'universe', 'skills', 'services', 'sponsorships')
            ->leftJoin('sponsorship_villain', 'villains.id', '=', 'sponsorship_villain.villain_id')
            ->select('villains.*')
            ->addSelect(\DB::raw('MAX(CASE WHEN sponsorship_villain.expiration_date > NOW() THEN 1 ELSE 0 END) as active_sponsorship'))
            ->groupBy('villains.id')
            ->orderByDesc('active_sponsorship')
            ->orderBy('name', 'asc');
        if ($request->has('universe_id')) {
            $query->where('universe_id', $request->input('universe_id'));
        }

        if ($request->has('skill_id')) {
            $query->whereHas('skills', function ($q) use ($request) {
                $q->where('id', $request->input('skill_id'));
            });
        }

        if ($request->has('service_id')) {
            $query->whereHas('services', function ($q) use ($request) {
                $q->where('id', $request->input('service_id'));
            });
        }

        if ($request->has('rating')) {
            $rating = $request->input('rating');
            $query->withAvg('ratings', 'value')
                ->having('ratings_avg_value', '>=', $rating);
        }

        if ($request->has('min_reviews')) {
            $minReviews = $request->input('min_reviews');
            $query->whereHas('ratings', function ($q) use ($minReviews) {
                $q->select('villain_id')
                    ->groupBy('villain_id')
                    ->havingRaw('COUNT(*) >= ?', [$minReviews]);
            });
        }


        $villains = $query->get();

        $maxReviews = Villain::withCount('ratings')
            ->orderBy('ratings_count', 'desc')
            ->first()
            ->ratings_count ?? 0;


        $success = $villains->isNotEmpty();

        return response()->json(compact('success', 'villains', 'maxReviews'));
    }

    public function storeMessage(Request $request)
    {
        $data = $request->all();

        $new_mess = new Message;

        $new_mess->fill($data);
        $new_mess->save();
        return response()->json(['message' => 'Messaggio salvato con successo!', 'data' => $new_mess], 201);
    }

    public function villainsSponsored()
    {

        $villains = Villain::whereHas('sponsorships', function ($query) {
            $query->where('expiration_date', '>', Carbon::now());
        })->get();

        if ($villains->isNotEmpty()) {
            $success = true;
        } else {
            $success = false;
            $villains = [];
        }

        return response()->json(compact('success', 'villains'));
    }

    public function storeRating(Request $request)
    {
        $validated = $request->validate([
            'villain_id' => 'required|exists:villains,id',
            'rating_id' => 'required|exists:ratings,id',
            'full_name' => 'required|string|min:1|max:255',
            'content' => 'required|string|max:1000'
        ]);

        $villain = Villain::find($validated['villain_id']);

        $villain->ratings()->attach($validated['rating_id'], [
            'full_name' => $validated['full_name'],
            'content' => $validated['content']
        ]);

        return response()->json(['message' => 'Rating saved successfully!'], 201);
    }
}
