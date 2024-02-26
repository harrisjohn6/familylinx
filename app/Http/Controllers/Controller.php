<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getBirthdays(ProfileService $profileService)
    {
        $user = Auth::user()->id; // Get the logged-in user
        $controllerResponseBirthdays = $profileService->getConnectedUserBirthdays($user);
        return response($controllerResponseBirthdays);
    }

}


