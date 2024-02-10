<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'linx';

    protected $fillable = [
        'user_id_1',
        'user_id_2',
        'relationship_type_id',
        'start_date',
        'is_biological',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relatedUser()
    {
        return $this->belongsTo(User::class, 'related_user_id');
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }
}
