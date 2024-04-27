<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'addressLine1',
        'addressLine2',
        'biologicalSex',
        'city',
        'dateBirth',
        'email',
        'email_verified_at',
        'genderId',
        'isRegistered',
        'name',
        'nameFirst',
        'nameLast',
        'nameMiddle',
        'namePrefix',
        'nameSuffix',
        'password',
        'phoneNumber',
        'phoneType',
        'profilePhoto',
        'remember_token',
        'state',
        'zip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
