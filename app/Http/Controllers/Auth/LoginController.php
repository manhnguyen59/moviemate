<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors([
                    'email' => 'Email hoặc mật khẩu không chính xác.',
                ])
                ->onlyInput('email', 'remember');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if (isset($user->status) && $user->status !== 'active') {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withErrors([
                    'email' => 'Tài khoản của bạn đang bị khóa hoặc chưa được kích hoạt.',
                ])
                ->onlyInput('email', 'remember');
        }

        return $this->redirectByRole();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Đăng xuất thành công.');
    }

    private function redirectByRole()
    {
        $roleName = strtolower(optional(Auth::user()->role)->name ?? 'user');

        if ($roleName === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        if ($roleName === 'staff') {
            return redirect()->intended(route('staff.dashboard'));
        }

        return redirect()->intended(route('home'));
    }
}
