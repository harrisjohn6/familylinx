<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use App\Services\FamilyTreeService;
use Illuminate\Support\Facades\Auth;
use App\Services\InviteFamilyService;
use App\Http\Requests\InviteFamilyRequest;

class InviteFamilyController extends Controller
{
    private $inviteFamilySerivce;
    private $relationship;
    private $familyTreeService;

    public function __construct(InviteFamilyService $inviteFamilySerivce, Relationship $relationship, FamilyTreeService $familyTreeService)
    {
        $this->inviteFamilySerivce = $inviteFamilySerivce;
        $this->relationship = $relationship;
        $this->familyTreeService = $familyTreeService;
    }


    /** CONTROLLER GET METHODS */

    public function getInviteForm()
    {
        $relationships = $this->relationship->all();
        return view("invite-family-form", compact("relationships"));
    }

    /** END CONTROLLER GET METHODS */

    /** CONTROLLER POST METHODS */

    public function postSendInvite(InviteFamilyRequest $request, InviteFamilyService $inviteFamilyService)
    {
        $validatedData = $request->validated();
        $inviteFamilyService->createSymbolicUser($validatedData);
        $nodes = [];
        $edges = [];

        $nodes = $this->familyTreeService->buildFamilyTreeNodes(Auth::user());
        $edges = $this->familyTreeService->buildFamilyTreeEdges(Auth::user());
        return view('family-tree', compact('nodes', 'edges'));

        // return back()->with('success', 'Invitation sent successfully!');
    }
    /** END CONTROLLER POST METHODS */
}
