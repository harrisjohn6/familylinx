<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Foundation\Auth\User;

class FamilyTreeService
{
    public function buildFamilyTreeNodes(User $user)
    {
        $nodes = [];
        $this->buildFamilyTreeNodesRecursive($user, $nodes);
        return $nodes;
    }

    public function buildFamilyTreeEdges(User $user)
    {
        $edges = [];

        $connections = Link::where('user_id_1', $user->id)
            ->orWhere('user_id_2', $user->id)
            ->get();

        foreach ($connections as $connection) {
            $edges[] = [
                'from' => $connection->user_id_1,
                'to' => $connection->user_id_2,
                'label' => $connection->relationship->relationship_title,
                'isSibling' => $connection->isSibling,
                'isParent' => $connection->isParent,
            ];
        }
        ;
        return ($edges);
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
                    'image' => url('/storage' . $linkedUser->profilePhoto)
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
}
