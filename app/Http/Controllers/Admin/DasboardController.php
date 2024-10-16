<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Villain;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    public function index()
    {
        $userVillain = Villain::where('user_id', Auth::id())->first();

        if ($userVillain) {
            return redirect()->route('admin.villains.index');
        } else {
            return redirect()->route('admin.villains.create')->with('success', 'Iscriviti qui per diventare un villain');
        }
    }
}
