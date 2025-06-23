<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'phone_number' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'farm_name' => 'required|string|max:255',
            'farm_location' => 'nullable|string|max:255',
            'farm_size' => 'nullable|string|max:255',
            'farm_type' => 'nullable|in:crop,livestock,mixed',
            'about_farmer' => 'nullable|string|max:1000',
            'social_media' => 'nullable|json',
            'farm_contact' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,avif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('/user/' . $user->id, $filename, 'profile_pictures');

            // Optional: delete old image
            if ($user->profile_picture && Storage::disk('profile_pictures')->exists($user->profile_picture)) {
                Storage::disk('profile_pictures')->delete($user->profile_picture);
            }
            // dd($path);
            $validated['profile_picture'] = $path;
        }



        // Update other fields
        $user->fill($validated);
        $user->save();
        // $user->update($validated);

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
