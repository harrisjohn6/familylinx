<?php

namespace APP\Models;

use Illuminate\Database\Eloquent\Model;


class Relationship extends Model
{
    protected $fillable = [
        'relationship_title',
        'parent_flag',
    ];

    function hasDirectLink($inviterId, $inviteeId, $relationshipId)
    {
        $relationship = Relationship::find($relationshipId);
        $relationships = Relationship::all();
        $directParentRelationships = $relationships->filter(function ($rel) {
            return $rel->hasDirectParent();
        });

        if (!$relationship->hasDirectParent()) {
            return false; // Relationship doesn't require a parent
        }

        // Child link check
        $childLink = Link::where('user_id_1', $inviterId)
            ->where('user_id_2', $inviteeId)
            ->where('relationship_type_id', $relationshipId)
            ->first();

        // Parent link check (if applicable)
        if ($relationship->hasDirectParent()) {
            $parentLink = Link::where('user_id_1', $inviteeId)
                ->where('user_id_2', $inviterId)
                ->where('relationship_type_id', $directParentRelationships->where('id', $relationshipId)->first()->id)
                ->first();

            return $childLink || $parentLink;
        }

        return $childLink; // Only check child link for non-parent relationships
    }

}
