<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class FamilyTreeService
{
    public function buildFamilyTreeNodes(User $user)
    {
        $nodes = [];
        $this->buildFamilyTreeNodesRecursive($user, $nodes);
        return $nodes;
    }


    private function buildFamilyTreeNodesRecursive(User $user, &$nodes, $depth = 0, $maxDepth = 3)
    {
        if ($depth >= $maxDepth) {
            return;  // Limit tree depth
        }

        $connections = Link::where('user_id_1', $user->id)
            ->orWhere('user_id_2', $user->id)
            ->get();

        if ($connections->isEmpty()) {
            // User has no relationships - single node only
            $nodes = [
                ['id' => $user->id, 'label' => $user->nameFirst . ' ' . $user->nameLast, 'image' => url('/storage' . $user->profilePhoto)]
            ];
        }

        foreach ($connections as $connection) {
            $linkedUserId = ($user->id === $connection->user_id_1) ? $connection->user_id_2 : $connection->user_id_1;

            $linkedUser = User::find($linkedUserId); // Fetch the complete User object

            if (!$this->userExistsInNodes($nodes, $linkedUserId)) {
                $nodes[] = [
                    'id' => $linkedUser->id,
                    'label' => $linkedUser->nameFirst . ' ' . $linkedUser->nameLast,
                    'image' => url('/storage' . $linkedUser->profilePhoto),
                    'posX' => null,
                    'posY' => null,
                ];
            }

            $nodes = array_values(array_unique($nodes, SORT_REGULAR)); // Removes potential duplicates
            $linkedUser = User::find($linkedUserId);
            // Recurse for the next generation connected to this person
            $this->buildFamilyTreeNodesRecursive($linkedUser, $nodes, $depth + 1, $maxDepth);
        }
    }

    // Helper function to check the `nodes` array
    private function userExistsInNodes($nodes, $userId)
    {
        foreach ($nodes as $node) {
            if (isset($node['id']) && $node['id'] == $userId) { // Assumes ID format "user-123"
                return true;
            }
        }
        return false;
    }

    public function buildFamilyTreeEdges(User $user)
    {
        $edges = [];
        $visitedNodes = new \SplObjectStorage();

        function getExpandedConnections(User $user, &$edges, &$visitedNodes, $depth = 0, $maxDepth = 3)
        {
            if ($visitedNodes->contains($user)) {
                return; // Already visited this node
            }

            if ($depth >= $maxDepth) {
                return; // Stop recursion if we reach the max depth
            }

            $visitedNodes->attach($user);

            $connections = Link::where('user_id_1', $user->id)
                ->orWhere('user_id_2', $user->id)
                ->get();

            foreach ($connections as $connection) {
                $userId1 = $connection->user_id_1;
                $userId2 = $connection->user_id_2;

                // Ensure consistent ordering (e.g., smaller ID always comes first)
                if ($userId1 > $userId2) {
                    $temp = $userId1;
                    $userId1 = $userId2;
                    $userId2 = $temp;
                }

                // Revised duplicate check
                $edgeExists = false;
                foreach ($edges as $existingEdge) {
                    if (
                        ($existingEdge['from'] === $userId1 && $existingEdge['to'] === $userId2) ||
                        ($existingEdge['from'] === $userId2 && $existingEdge['to'] === $userId1)
                    ) {
                        $edgeExists = true;
                        break;
                    }
                }
                if (!$edgeExists) {

                    // Determine parent-child relationship (if applicable)
                    $parent = null;
                    $child = null;
                    if ($connection->isParent) {
                        $parent = $connection->user_id_2; // Parent is in user_id_2 column
                        $child = $connection->user_id_1;
                    }

                    // Create the edge
                    $edges[] = [
                        'from' => $child ?? $userId1, // Child or smaller ID
                        'to' => $parent ?? $userId2,  // Parent or larger ID
                        'label' => $connection->relationship->relationship_title,
                        'isSibling' => $connection->isSibling,
                        'isParent' => $connection->isParent
                    ];
                }
                // Recursion
                $otherUser = User::find($userId1 === $user->id ? $userId2 : $userId1);
                getExpandedConnections($otherUser, $edges, $visitedNodes, $depth + 1, $maxDepth);
            }
        }

        // Start the recursion
        getExpandedConnections($user, $edges, $visitedNodes);

        return $edges;
    }


    public function getClusters($nodeId)
    {
        $parentNodesString = DB::table('viewparentchildlinx')
            ->select('ParentNodes')
            ->where('childNode', $nodeId)
            ->value('ParentNodes');

        if ($parentNodesString) {
            $parentNodes = explode(',', $parentNodesString);

            // Ensure we have a valid cluster (more than one parent)
            if (count($parentNodes) > 1) {
                $clusterId = implode('-', $parentNodes); // Create cluster ID

                return [
                    'id' => $clusterId,
                    'physics' => false,
                    'nodes' => $parentNodes,
                    // 'childNode' => $nodeId,
                ];
            } else {
                return null; // Indicate an invalid single-node cluster
            }
        } else {
            return null; // Return null if no parents are found
        }
    }

    private function createCluster($parentNodes)
    {
        $clusterId = implode('-', $parentNodes); // Generate ID from parent nodes

        return [
            'id' => $clusterId,
            'nodes' => $parentNodes
        ];
    }

}
