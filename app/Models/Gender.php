<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable = [
        'gender_identity',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
