<?php

namespace SujanSht\LaraAdmin\Http\Controllers\Auth;

use SujanSht\LaraAdmin\Http\Controllers\Controller;
use SujanSht\LaraAdmin\Models\Admin\Role;
use SujanSht\LaraAdmin\Models\User;
use SujanSht\LaraAdmin\Providers\LaraAdminServiceProvider;
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
        return view('lara-admin::auth.register');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('name', 'user')->first();

        $user->roles()->attach($role);

        event(new Registered($user));

        Auth::login($user);

        return redirect(LaraAdminServiceProvider::HOME);
    }
}
