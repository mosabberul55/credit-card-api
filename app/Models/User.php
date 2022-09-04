<?php

namespace App\Models;

use App\Traits\GenerateUserName;
use App\Traits\HasPhoto;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, GenerateUserName, HasPhoto;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'photo',
        'phone',
        'email',
        'password',
        'department_id',
        'dob',
        'gender',
        'type',
        'ip',
        'created_by',
        'approved',
        'active',
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
        'id' => 'integer',
        'department_id' => 'integer',
        'dob' => 'date',
        'approved' => 'boolean',
        'active' => 'boolean',
    ];

    public function cardApplications()
    {
        return $this->hasMany(CardApplication::class);
    }
}
