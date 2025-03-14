<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'user_name' => str_replace(' ','',$request->name),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 0,
            'password' => Hash::make($request->password),
        ]);

        if (count(User::all()) == 1) {
            $user->update(['status' => 1]);
            $user->addRole('administrator');
        }
        else {
            $user->addRole('user');
        }
        event(new Registered($user));
        return back()->with('success', 'Data has been saved successfully');
//        Auth::login($user);
//
//        return redirect(RouteServiceProvider::HOME);
    }
}
