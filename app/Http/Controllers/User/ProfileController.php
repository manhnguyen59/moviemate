<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LoyaltyPointTransaction;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('user.profile.index', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
        ]);

        $request->user()->update($validated);

        return redirect()
            ->route('user.profile')
            ->with('success', 'Cập nhật thông tin cá nhân thành công.');
    }

    public function loyaltyHistory(Request $request)
    {
        $query = LoyaltyPointTransaction::query()
            ->where('user_id', $request->user()->id)
            ->with(['booking.showtime.movie']);

        if ($request->filled('type')) {
            $query->where('type', $request->query('type'));
        }

        $transactions = $query->latest()->paginate(12)->withQueryString();

        $summary = [
            'available_points' => (int) $request->user()->loyalty_points,
            'lifetime_points' => (int) $request->user()->lifetime_loyalty_points,
            'earned_points' => LoyaltyPointTransaction::where('user_id', $request->user()->id)
                ->where('points', '>', 0)
                ->sum('points'),
            'used_points' => abs((int) LoyaltyPointTransaction::where('user_id', $request->user()->id)
                ->where('points', '<', 0)
                ->sum('points')),
        ];

        return view('user.profile.loyalty-history', [
            'user' => $request->user(),
            'transactions' => $transactions,
            'summary' => $summary,
            'selectedType' => $request->query('type'),
        ]);
    }
}
