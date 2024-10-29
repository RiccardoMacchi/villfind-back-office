<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\View;
use App\Models\Rating;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        $villainId = Auth::id();

        $months = [];
        foreach (range(0, 11) as $i) {
            $month = Carbon::now()->subMonths($i)->format('F');
            $months[$month] = 0;
        }
        $months = array_reverse($months, true);

        // Statistiche visualizzazioni
        $monthlyViews = View::where('villain_id', $villainId)
        ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
        ->where('created_at', '>=', Carbon::now()->subYear())
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();

        $viewsMonthly = array_merge($months, $monthlyViews);

        // Statistiche valutazioni
        $monthlyReviews = DB::table('rating_villain')
            ->where('villain_id', $villainId)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
            ->where('created_at', '>=', Carbon::now()->subYear())
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();



        // Statistiche messaggi
        $monthlyMessages = Message::where('villain_id', $villainId)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
            ->where('created_at', '>=', Carbon::now()->subYear())
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $messagesMonthly = array_merge($months, $monthlyMessages,);
        // dd($monthlyViews, $monthlyReviews, $monthlyMessages );

        return view('admin.statistic.index', compact('monthlyViews','monthlyReviews', 'monthlyMessages', 'months'));
    }
}
