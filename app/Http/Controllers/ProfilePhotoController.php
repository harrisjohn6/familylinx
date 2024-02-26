<?php

namespace App\Http\Controllers;


use App\Http\Requests\UpdateProfilePhotoRequest;
use App\Http\Controllers\Controller;
use App\Services\ProfilePhotoService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    private $profilePhotoService;

    public function __construct(ProfilePhotoService $profilePhotoService)
    {
        $this->profilePhotoService = $profilePhotoService;
    }
    public function update(UpdateProfilePhotoRequest $request)
    {

        $this->profilePhotoService->updateProfilePhoto($request->user(), $request);
        return redirect(Route("profile.edit"))->with('message', 'Profile Photo Uploaded');
    }

}
