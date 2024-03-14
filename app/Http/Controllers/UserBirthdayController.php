<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBirthdayController extends Controller
{
    public function getBirthdays($userId)
    {
        $birthdays = DB::select('CALL getConnectedUserBirthdays(?)', [$userId]);

        return response()->json($birthdays);
    }
}
