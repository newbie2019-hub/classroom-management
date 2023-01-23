<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'gender', 'contact', 'address', 'email'];
}
