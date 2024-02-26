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
            'genderId' => '9',
            'isRegistered' => false // Key - Denotes this is a symbolic user
        ]);
        $this->createUserLinx(auth()->user()->id, $newUserId, $newSymUser['inviteRelationshipId']);
    }


    /**
     * Authenticated User, New User, User relationship Id
     */
    public function createUserLinx(int $AuthUser1, int $newUser, int $relationshipId)
    {
        $relationship = Relationship::find($relationshipId);
        Link::create([
            'user_id_1' => $AuthUser1,
            'user_id_2' => $newUser,
            'is_biological' => '1',
            'relationship_type_id' => $relationshipId,
            'isSibling' => $relationship->isSibling,
            'isParent' => $relationship->isParent,
        ]);
    }
}
