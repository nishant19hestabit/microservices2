<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password', 'address', 'profile_picture',
        'current_school', 'previous_school', 'role_id', 'teacher_assigned', 'experience', 'expertise_subject',
        'father_name', 'mother_name', 'is_approved'
    ];

    protected $hidden = ['password'];
}
