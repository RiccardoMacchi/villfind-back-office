<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\View;
use Carbon\Carbon;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $views = View::orderBy('created_at')->where('villain_id', Auth::id());

        $villainId = Auth::id();
        $totalViews = View::where('villain_id', $villainId)->where('created_at', '>=', Carbon::now()->subYear())->count();
        $monthlyViews = View::where('villain_id', $villainId)
                        ->where('created_at', '>=', Carbon::now()->subYear())
                        ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as views")
                        ->groupBy('month')
                        ->orderBy('month', 'desc')
                        ->get();

        // if($monthlyViews){
        $sixMonthViews = View::where('villain_id', $villainId)
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->selectRaw("DATE_FORMAT(created_at, 'Y-m') as month, COUNT(*) as views")
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.views.index', compact('totalViews', 'monthlyViews', 'sixMonthViews'));

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
