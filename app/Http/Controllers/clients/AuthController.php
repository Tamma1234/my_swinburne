<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->user() != "") {
            $user = auth()->user();
            return redirect()->route('profile.detail', ['hash' => $user->hash_id]);
        } else {
            $email = $request->email;
            $user = User::where('email', $email)->first();

            if ($user) {
                if ($user->is_active == 1 && $user->user_level == 3) {
                    $credentials = $request->validate([
                        'email' => ['required'],
                        'password' => ['required'],
                    ]);
                    // Ghi nhớ đăng nhập
                    $remenber = $request->remember_token;
                    /**
                     * Dùng Auth::attempt xem email,password có trong table users k
                     *  Nếu có thì dùng session để lưu, ghi nhớ thông tin login
                     * Sau đó chuyển hướng đến trang dasboard
                     */
                    if (auth()->attempt($credentials, $remenber)) {
                        $request->session()->regenerate();
                        return redirect()->route('profile.detail', ['hash' => $user->hash_id]);
                    }

                    // Còn không sẽ trả về back và hiển thị lỗi email
                    return back()->withErrors([
                        'email' => 'The provided credentials do not match our records.',
                    ]);
                } else {
                    return redirect()->route('home')->with('success', 'Please check your email to activate your registered account');

                }
            } else {
                return redirect()->route('home');
            }
        }
    }
    /**
     * edit.
     *
     * @return login
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

}
