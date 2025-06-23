<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        // Validate the input data
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'whatsapp' => ['required', 'string', 'max:15'],
            'farm_name' => ['nullable', 'string', 'max:255'],
            'farm_location' => ['nullable', 'string', 'max:255'],
            'farm_size' => ['nullable', 'string', 'max:50'],
            'farm_type' => ['nullable', 'in:crop,livestock,mixed'],
            'farm_products' => ['nullable', 'string'],
            'about_farmer' => ['nullable', 'string'],
            'social_media' => ['nullable', 'json'],
            'role' => ['nullable', 'enum:farmer,buyer', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // dd($validated);

        // Create the user
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'whatsapp_number' => $validated['whatsapp'],
            'farm_name' => $validated['farm_name'] ?? null,
            'farm_location' => $validated['farm_location'] ?? null,
            'farm_size' => $validated['farm_size'] ?? null,
            'farm_type' => $validated['farm_type'] ?? null,
            'farm_products' => $validated['farm_products'] ?? null,
            'about_farmer' => $validated['about_farmer'] ?? null,
            'social_media' => $validated['social_media'] ?? null,
            'password' => Hash::make($validated['password']),
        ]);

        // Fire the Registered event
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        // Redirect to the dashboard or appropriate page
        return redirect(route('dashboard'));
    }
}
