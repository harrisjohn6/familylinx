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
        'created_at',
        'updated_at',
        'is_biological',
    ];

    public function user1() // More descriptive name
    {
        return $this->belongsTo(User::class, 'user_id_1');
    }

    public function user2() // Either user_id_1 or user_id_2 can be the 'related' one
    {
        return $this->belongsTo(User::class, 'user_id_2');
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class, 'relationship_type_id');
    }





}
