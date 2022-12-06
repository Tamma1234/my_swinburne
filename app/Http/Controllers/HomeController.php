<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Branch;
use App\Models\User;
use App\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{

    public function index() {
        if (auth()->user() != "") {
            return redirect()->route('home');
        } else {
            return view('clients.auth.login');
        }
    }

    public function register() {
        return view('clients.auth.register');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegisterRequest $request)
    {
        $link = "http://127.0.0.1:8000";
        $email = $request->email;
        $full_name = $request->full_name;
        $phone_number = $request->phone_number;
        $password = "123@123a";
        $hashPassword = Hash::make($password);
        $user = User::create([
            'full_name' => $full_name,
            'email' => $email,
            'phone_number' => $request->phone_number,
            'password' => $hashPassword,
            'is_active' => 0
        ]);
        $id = $user->id;
        $hashId = Hash::make($id . 'swin');
        $hashString = substr($hashId, 0, 14);
        $path = 'qr-code/' . $hashString . ".svg";
        $qr_code = QrCode::size(300)->margin(10)->generate($link, public_path($path));
        $link = $hashString . ".svg";
        User::where('id', $id)->update([
            'hash_id' => $hashString,
            'path' => $link
        ]);

        Service::getSendMail()->sendPaymentMail($email, $full_name, $phone_number, $password);

        return redirect()->route('home')->with('success', 'Please check your email to activate your registered account');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function confirm(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->update([
            'is_active' => 1
        ]);
         return view('login')->with('active', 'account activation successful');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profileDetail() {
        $user = auth()->user();
        $business = Branch::where('is_active', 2)->get();
        $media = Branch::where('is_active', 3)->get();
        $information = Branch::where('is_active', 1)->get();

//        $qrCode = QrCode::generate('Welcome to Makitweb', public_path('images/qrcode.svg') );

        return view('clients.home.profile', compact('user', 'business', 'media', 'information'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request) {
        $data = $request->all();
        $id = $request->id;
        $user = User::where('id', $id)->first();
        $user->update($data);

        return back()->with('success', 'Update Account successful');
    }
}
