<?php

namespace App\Http\Controllers;


use App\Http\Requests\UpdateProfilePhotoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    public function update(UpdateProfilePhotoRequest $request)
    {
        if ($oldAvatar = $request->user()->profile_photo) {
            Storage::disk('public')->delete($oldAvatar);
        }

        $path = Storage::disk('public')->put('profile_photos', $request->file('profile_photo'));
        auth()->user()->update(['profile_photo' => "/$path"]);


        return redirect(Route("profile.edit"))->with('message', 'Profile Photo Uploaded');
    }


}
