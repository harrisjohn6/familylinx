<?php

namespace App\Services;

use App\Models\Link;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Relationship;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\InviteFamilyRequest;

class InviteFamilyService
{

    /**
     * If $linkToId is null, the link will be created direct to authenticated user
     */
    public function createSymbolicUser(array $newSymUser)
    {
        $newUserId = User::insertGetId([
            "name" => $newSymUser["inviteNameFirst"] . " " . $newSymUser["inviteNameLast"],
            'nameFirst' => $newSymUser['inviteNameFirst'],
            'nameMiddle' => $newSymUser['inviteNameMiddle'],
            'nameLast' => $newSymUser['inviteNameLast'],
            'email' => $newSymUser['inviteEmail'],
            'dateBirth' => $newSymUser['inviteDateBirth'],
            'biologicalSex' => $newSymUser['inviteBiologicalSex'],
            'password' => Hash::make(Str::random(50)),
            'genderId' => '27',
            'isRegistered' => false // Key - Denotes this is a symbolic user
        ]);

        $userIdLink1 = $newSymUser["addedFromFamilyId"];

        $this->createUserLinx($userIdLink1, $newUserId, $newSymUser['inviteRelationshipId']);
    }

    /**
     * Authenticated User, New User, User relationship Id
     */
    public function createUserLinx(int $userExisting, int $userNew, int $relationshipId)
    {


        $relationship = Relationship::find($relationshipId);
        if ($relationship->isParent || $relationship->relationship_title != 'Child') {
            $position2 = $userNew;
            $position1 = $userExisting;
        } else {
            $position1 = $userNew;
            $position2 = $userExisting;
        }
        Link::create([
            'user_id_1' => $position1,
            'user_id_2' => $position2,
            'is_biological' => '1',
            'relationship_type_id' => $relationshipId,
            'isSibling' => $relationship->isSibling,
            'isParent' => $relationship->isParent,
        ]);
    }
}
