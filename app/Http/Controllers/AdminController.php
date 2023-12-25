<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalRestaurant = Restaurant::count();
        $Earnings = Order::where('status', 'Delivered')->select('grandTotal')->get()->toArray();
        $totalEarning = 0;
        foreach ($Earnings as $earned) {
            $totalEarning += $earned['grandTotal'] * 1.2;
        }

        $totalEarningsPerMonth = Order::where('status', 'Delivered')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(grandTotal * 0.20) as total_earning_percentage')
            )
            ->groupBy('year', 'month')
            ->get();
        $totalEarningsPerMonth = $totalEarningsPerMonth->map(function ($earning) {
            $earning->month = Carbon::createFromDate(null, $earning->month, null)->monthName;
            return $earning;
        });

        $topFiveUsers = Order::select('users.username as user_name', 'users.id as user_id', DB::raw('SUM(orders.grandTotal) as total_ordered'))
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.username')
            ->orderByDesc('total_ordered')
            ->take(5)
            ->get();

        return view('Admin.index', compact('totalUsers', 'totalRestaurant', 'totalEarning', 'totalEarningsPerMonth'))->with('topFiveUsers', $topFiveUsers);
    }
}
