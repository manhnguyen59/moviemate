<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->with('role')
            ->withSum(['bookings as total_spent' => fn ($query) => $query->where('payment_status', 'paid')], 'total_amount')
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = trim((string) $request->search);
                $query->where(fn ($query) => $query->where('name', 'like', "%{$term}%")->orWhere('email', 'like', "%{$term}%")->orWhere('phone', 'like', "%{$term}%"));
            })
            ->when($request->filled('role_id'), fn ($query) => $query->where('role_id', $request->role_id))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('tier'), fn ($query) => match ($request->tier) {
                'member' => $query->where('lifetime_loyalty_points', '<', 500),
                'silver' => $query->whereBetween('lifetime_loyalty_points', [500, 999]),
                'gold' => $query->whereBetween('lifetime_loyalty_points', [1000, 1999]),
                'diamond' => $query->where('lifetime_loyalty_points', '>=', 2000),
                default => $query,
            })
            ->latest()->paginate(15)->withQueryString();

        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function show(User $user)
    {
        $user->load(['role', 'bookings' => fn ($query) => $query->with('showtime.movie')->latest()->limit(10), 'reviews.movie']);
        $stats = [
            'spent' => $user->bookings()->where('payment_status', 'paid')->sum('total_amount'),
            'tickets' => $user->bookings()->where('payment_status', 'paid')->count(),
            'reviews' => $user->reviews()->count(),
            'cancelled' => $user->bookings()->where('booking_status', 'cancelled')->count(),
            'redeemed' => abs((int) $user->loyaltyPointTransactions()->where('type', 'redeem')->sum('points')),
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }
}
