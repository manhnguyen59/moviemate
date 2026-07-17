<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Throwable;

class GoogleAuthController extends Controller
{
    public function redirect(): SymfonyRedirectResponse|RedirectResponse
    {
        if (! config('services.google.client_id') || ! config('services.google.client_secret')) {
            return redirect()->route('login')->withErrors([
                'google' => 'Đăng nhập Google chưa được cấu hình. Vui lòng liên hệ quản trị viên.',
            ]);
        }

        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $exception) {
            Log::warning('Google OAuth callback failed.', ['message' => $exception->getMessage()]);

            return redirect()->route('login')->withErrors([
                'google' => 'Không thể đăng nhập bằng Google. Vui lòng thử lại.',
            ]);
        }

        $email = $googleUser->getEmail();

        if (! $email) {
            return redirect()->route('login')->withErrors([
                'google' => 'Tài khoản Google không cung cấp địa chỉ email.',
            ]);
        }

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $email)
            ->first();

        if (! $user) {
            $role = Role::whereIn('name', ['User', 'user'])->first()
                ?? Role::create(['name' => 'User']);
            $user = User::create([
                'name' => $googleUser->getName() ?: Str::before($email, '@'),
                'email' => $email,
                'password' => Str::random(64),
                'google_id' => $googleUser->getId(),
                'role_id' => $role->id,
                'status' => 'active',
                'email_verified_at' => now(),
            ]);
        } elseif (! $user->google_id) {
            $user->forceFill([
                'google_id' => $googleUser->getId(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ])->save();
        }

        if ($user->status !== 'active') {
            return redirect()->route('login')->withErrors([
                'google' => 'Tài khoản của bạn đang bị khóa hoặc chưa được kích hoạt.',
            ]);
        }

        Auth::login($user, true);
        request()->session()->regenerate();

        return redirect()->intended(route('home'));
    }
}
