<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    public function create()
    {
        return view('session.login-session');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            $user = Auth::user();
            
            if ($user->google2fa_secret) {
                session(['2fa_user_id' => $user->id]);
                Auth::logout();
                
                return redirect()->route('2fa.verify')->with(['info' => 'Please enter your 2FA code.']);
            }
            
            session()->regenerate();
            return redirect('dashboard')->with(['success' => 'You are logged in.']);
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function show2faVerify()
    {
        if (!session('2fa_user_id')) {
            return redirect('/login');
        }
        
        return view('session.2fa-verify');
    }

    public function verify2fa(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric|digits:6'
        ]);

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect('/login')->withErrors(['error' => 'Session expired. Please login again.']);
        }

        $user = \App\Models\User::find($userId);
        if (!$user) {
            return redirect('/login')->withErrors(['error' => 'User not found.']);
        }

        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if ($valid) {
            Auth::login($user);
            session()->forget('2fa_user_id');
            session()->regenerate();
            
            return redirect('dashboard')->with(['success' => 'You are logged in.']);
        } else {
            return back()->withErrors(['code' => 'Invalid 2FA code. Please try again.']);
        }
    }

    public function show2faSetup()
    {
        $user = Auth::user();
        
        if ($user->google2fa_secret) {
            return redirect('dashboard')->with(['info' => '2FA is already enabled for your account.']);
        }

        $secret = $this->google2fa->generateSecretKey();
        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        // Generate QR code image
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodeImage = base64_encode($writer->writeString($qrCodeUrl));

        return view('session.2fa-setup', compact('secret', 'qrCodeImage'));
    }

    public function enable2fa(Request $request)
    {
        $request->validate([
            'secret' => 'required',
            'code' => 'required|numeric|digits:6'
        ]);

        $user = Auth::user();
        $valid = $this->google2fa->verifyKey($request->secret, $request->code);

        if ($valid) {
            $user->google2fa_secret = $request->secret;
            $user->save();

            return redirect('dashboard')->with(['success' => '2FA has been enabled successfully!']);
        } else {
            return back()->withErrors(['code' => 'Invalid 2FA code. Please try again.']);
        }
    }

    public function disable2fa(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'code' => 'required|numeric|digits:6'
        ]);

        $user = Auth::user();

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Invalid password.']);
        }

        // Verify 2FA code
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if ($valid) {
            $user->google2fa_secret = null;
            $user->save();

            return redirect('dashboard')->with(['success' => '2FA has been disabled successfully!']);
        } else {
            return back()->withErrors(['code' => 'Invalid 2FA code. Please try again.']);
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->forget('2fa_user_id');

        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}