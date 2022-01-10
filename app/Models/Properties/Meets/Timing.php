<?php

namespace App\Models\Properties\Meets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timing extends Model
{
    use HasFactory;

    protected $table = 'timing_methods';
    protected $fillable = ['name'];
}
