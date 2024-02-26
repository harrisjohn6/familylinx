<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\View\View;
use APP\Models\Relationship;
use Illuminate\Http\Request;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $genders = $this->profileService->getGenders();
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


        $validatedData = $request->validated();  // Get all your validated data at once
        $request->user()->fill($validatedData);  // Update user data

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
