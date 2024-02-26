<?php

namespace App\Services;

use App\Models\Gender;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileService
{
    private $genders;
    public function __construct()
    {
        $this->genders = Gender::all();
    }

    public function getGenders()
    {

        return $this->genders;

    }

    public function getConnectedUserBirthdays(int $userId)
    {
        $rawBirthdays = DB::select('CALL getConnectedUserBirthdays(?)', [$userId]);

        // Transform into the expected format
        $serviceReturnBirthdays = array_map(function ($data) {
            return [
                'id' => $data->id,
                'dateBirth' => $data->dateBirth,
                'Name' => $data->Name
            ];
        }, $rawBirthdays);

        return $serviceReturnBirthdays;
    }
}
