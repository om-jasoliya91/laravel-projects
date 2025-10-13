<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'dob', 'age', 'city', 'gender', 'hobby',
        'salary', 'password', 'address', 'profile'];

    protected $casts = [
        'is_admin' => 'boolean',  // converts 0/1 to true/false
        'dob' => 'datetime',  // converts string to Carbon instance
        'options' => 'array',  // converts JSON to array
        'password' => 'hashed',  // automatically hashes password
    ];
}
