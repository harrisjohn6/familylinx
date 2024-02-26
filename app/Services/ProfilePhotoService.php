<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfilePhotoRequest;

class ProfilePhotoService
{
    public function updateProfilePhoto(User $user, UpdateProfilePhotoRequest $request)
    {
        if ($oldAvatar = $request->user()->profile_photo) {
            Storage::disk('public')->delete($oldAvatar);
        }

        $path = Storage::disk('public')->put('profile_photos', $request->file('profilePhoto'));
        auth()->user()->update(['profilePhoto' => "/$path"]);

    }
}
