<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Universe;
use App\Models\Villain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            $villains = Villain::where('name', 'LIKE', '%' . $_GET['search'] . '%')->orderBy('name')->with('skills', 'universe', 'services', 'ratings')->paginate(12);
        } else {
            $villains = Villain::orderBy('name')->with('skills', 'universe', 'services', 'ratings')->paginate(12);
        }

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

    public function villainBySlug($slug)
    {
        $villain = Villain::where('slug', $slug)->with('skills', 'universe', 'services', 'ratings')->first();
        if ($villain) {
            $success = true;
            if ($villain->image) {
                $villain->image = Storage::url($villain->image);
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

    public function listBySkillId($id)
    {

        $skills = Skill::where('id', $id)->with('villains', 'villains.ratings', 'villains.services')->first();

        if ($skills) {
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'skills'));
    }
}
