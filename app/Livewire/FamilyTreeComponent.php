<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\FamilyTreeService;
use Illuminate\Support\Facades\Auth;

class FamilyTreeComponent extends Component
{
    public function render()
    {
        $familyTreeService = new FamilyTreeService;
        $nodes = $familyTreeService->buildFamilyTreeNodes(Auth::user());
        $edges = $familyTreeService->buildFamilyTreeEdges(Auth::user());
        
        return view('livewire.family-tree-component', compact('nodes', 'edges'));
    }
}
