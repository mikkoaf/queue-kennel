<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    public const WEIGHT_MIN = 1000;
    public const WEIGHT_MAX = 70000;
    public const ADULT_DOG_TEETH_COUNT = 42;

}
