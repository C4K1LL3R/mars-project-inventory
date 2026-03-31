<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class apps extends Model
{
    protected $fillable = ['name', 'price', 'description'];
}
