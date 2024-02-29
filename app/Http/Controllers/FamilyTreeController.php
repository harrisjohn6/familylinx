<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteFamilyRequest;
use App\Models\Link;
use App\Services\FamilyTreeService;
use App\Services\InviteFamilyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FamilyTreeController extends Controller
{
    private $familyTreeService;
    private $inviteFamilyService;

    public function __construct(FamilyTreeService $familyTreeService, InviteFamilyService $inviteFamilyService)
    {
        $this->familyTreeService = $familyTreeService;
        $this->inviteFamilyService = $inviteFamilyService;
    }


    public function getFamilyTree()
    {
        $nodes = $this->familyTreeService->buildFamilyTreeNodes(Auth()->user());
        $edges = $this->familyTreeService->buildFamilyTreeEdges(Auth()->user());
        return view('family-tree', compact('nodes', 'edges'));

    }
    public function getGoJsFamilyTree()
    {
        $nodeDataArray = $this->familyTreeService->buildFamilyTreeNodes(Auth()->user());
        $linkDataArray = $this->familyTreeService->buildFamilyTreeEdges(Auth()->user());

        return view('go-family-tree', compact('nodeDataArray', 'linkDataArray'));
    }

    public function postAddFamilyTreeMember(InviteFamilyRequest $request)
    {
        $validatedData = $request->validated();

        $fromFamilyId = $validatedData->fromFamilyId;

        $this->inviteFamilyService->createSymbolicUser($validatedData, $fromFamilyId);
        $updatedNodes = $this->familyTreeService->buildFamilyTreeNodes(Auth()->user());
        $updatedEdges = $this->familyTreeService->buildFamilyTreeEdges(Auth()->user());
        return response()->json([
            'nodes' => $updatedNodes, // Assuming you have updated nodes data
            'edges' => $updatedEdges // Assuming you have updated edges data
        ]);
    }

}




