<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20', 'confirmed'],
            'user_type' =>['required', 'string'],
            'agreement' => ['accepted'],
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );


        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Member::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
        Auth::login($user); 
        return redirect('/dashboard');
    }
}
