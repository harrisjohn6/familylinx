<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class FamilyTreeController extends Controller
{
    public function buildFamilyTree()
    {
        // ... Fetch Linx connections (adjust your query if needed)
        $connections = Link::all();

        $nodes = [];
        $edges = [];

        foreach ($connections as $connection) {
            // For simplicity prefixing both connected users, as we don't have direct names from joins yet
            $nodes[] = ['id' => "user-" . $connection->user_id_1, 'label' => 'User ' . $connection->user_id_1];
            $nodes[] = ['id' => "user-" . $connection->user_id_2, 'label' => 'User ' . $connection->user_id_2];

            $edges[] = [
                'from' => "user-" . $connection->user_id_1,
                'to' => "user-" . $connection->user_id_2,
                'label' => $connection->relationship->relationship_title
            ];
        }

        // Ensuring Unique Nodes (Optimization):
        $nodes = array_values(array_unique($nodes, SORT_REGULAR)); // Removes potential duplicates from node generation

        return view('family-tree', compact('nodes', 'edges'));

    }
}
