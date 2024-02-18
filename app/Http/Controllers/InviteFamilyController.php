<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Requests\InviteFamilyRequest;
use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InviteFamilyController extends Controller
{

    public function create()
    {
        $relationships = Relationship::all();
        return view("invite-family-form", compact("relationships"));
    }

    public function sendInvite(InviteFamilyRequest $request)
    {
        $validatedData = $request->validated();

        // 1. Create Symbolic User
        $newUserId = User::insertGetId([
            'name' => $validatedData['inviteName'],
            'email' => $validatedData['inviteEmail'],
            'date_birth' => $validatedData['inviteDateBirth'],
            'biological_sex' => $validatedData['inviteBiologicalSex'],
            'password' => Hash::make(Str::random(50)),
            'gender_id' => '9',
            'is_registered' => false // Key - Denotes this is a symbolic user
        ]);

        // 2. Create 'Linx' Record
        Link::create([
            'user_id_1' => auth()->id(),
            'user_id_2' => $newUserId,
            'is_biological' => '1',
            'relationship_type_id' => $validatedData['inviteRelationshipId'],
        ]);

        // 3. Send Invite Email
        // Mail::to($validatedData['inviteEmail'])
        //    ->send(new InviteFamilyMailable($newUserId, $validatedData));
//
        // Return with a success message (customize as needed)
        return back()->with('success', 'Invitation sent successfully!');
    }
}
