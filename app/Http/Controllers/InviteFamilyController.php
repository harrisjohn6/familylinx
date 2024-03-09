<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use App\Services\FamilyTreeService;
use Illuminate\Support\Facades\Auth;
use App\Services\InviteFamilyService;
use App\Http\Requests\InviteFamilyRequest;
use App\Services\BaseService;

class InviteFamilyController extends Controller
{
    private $inviteFamilySerivce;
    private $relationship;
    private $familyTreeService;
    private $baseService;

    public function __construct(InviteFamilyService $inviteFamilySerivce, Relationship $relationship, FamilyTreeService $familyTreeService, BaseService $baseService)
    {
        $this->inviteFamilySerivce = $inviteFamilySerivce;
        $this->relationship = $relationship;
        $this->familyTreeService = $familyTreeService;
        $this->baseService = $baseService;
    }


    /** CONTROLLER GET METHODS */

    public function getInviteForm()
    {
        $relationships = $this->baseService->getRelationships();
        return view("invite-family-form", compact("relationships"));
    }

    /** END CONTROLLER GET METHODS */

    /** CONTROLLER POST METHODS */

    public function postSendInvite(InviteFamilyRequest $request, InviteFamilyService $inviteFamilyService)
    {
        $authUser = Auth::user();
        $nodes = [];
        $edges = [];

        $validatedData = $request->validated();

        $inviteFamilyService->createSymbolicUser($validatedData);

        $nodes = $this->familyTreeService->buildFamilyTreeNodes($authUser);
        $edges = $this->familyTreeService->buildFamilyTreeEdges($authUser);
        $clusters = $this->familyTreeService->getClusters($authUser);
        return view('family-tree', compact('nodes', 'edges'));
        // return back()->with('success', 'Invitation sent successfully!');

    }

    /** END CONTROLLER POST METHODS */
}
