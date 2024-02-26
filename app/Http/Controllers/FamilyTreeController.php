<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Services\FamilyTreeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FamilyTreeController extends Controller
{
    private $familyTreeService;

    public function __construct(FamilyTreeService $familyTreeService)
    {
        $this->familyTreeService = $familyTreeService;
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
}




