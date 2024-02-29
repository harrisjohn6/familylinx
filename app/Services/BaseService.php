<?php

namespace App\Services;

use App\Models\Relationship;
use Illuminate\Http\JsonResponse;

class BaseService
{
    private $relationship;

    public function __construct(Relationship $relationship)
    {
        $this->relationship = $relationship;
    }

    public function getRelationships()
    {
        return $this->relationship->get()->all();
    }
}
