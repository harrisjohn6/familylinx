<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Gender;
use Faker\Provider\bg_BG\PhoneNumber;
use APP\Models\Relationship;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Fetch data and prepare an array for both gender identity and biological sex
        $genders = Gender::select('gender_id', 'gender_identity')->get();

        // Pass 'genders' to the view
        return view('profile.edit', [
            'genders' => $genders,
            'user' => $request->user(),
        ]);

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        Log::info('Before Validation $request', $request->all());
        $validatedData = $request->validated();  // Get all your validated data at once
        Log::info('After Validation $validatedData', $validatedData);



        $request->user()->fill($validatedData);  // Update user data
        Log::info('After user Fill', $validatedData);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
