<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Specify the fields that are mass assignable
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'profile_image',
    ];
}
