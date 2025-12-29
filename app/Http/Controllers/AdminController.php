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

    public function res_users(){
        $users = User::where('role','=',2)->get();
        return view('admin.users',compact('users'));
    }

    public function add_res_user(){
        
        return view('admin.add_user');
    }

    public function save_user(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
        ]);

        $role = 2;

        // Create the user
        $user = User::create([
            'username' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone'],
            'password' => $validated['password'],  // Encrypt the password
            'role'=>$role,
        ]);

        // Redirect or return response
        return redirect()->back()->with('success', 'User saved successfully!');
    }

    public function delete_user($id){
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        // Delete the user
        $user->delete();

        // Redirect or return a response
        return redirect()->route('res_users')->with('success', 'User deleted successfully!');
    }

    public function edit_user($id){
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        if($user){
            return view('admin.edit_user',compact('user'));
        }
    }

    public function update_user($id, Request $request)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        // Validate the incoming request (excluding password)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|numeric',
        ]);

        // Update the user details without changing the password
        $user->username = $validated['name'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone'];

        // Save the updated user
        $user->save();

        // Redirect or return a response
        return redirect()->route('res_users')->with('success', 'User updated successfully!');
    }
}
