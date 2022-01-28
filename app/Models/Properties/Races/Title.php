<?php

namespace App\Models\Properties\Races;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $table = 'race_titles';

    protected $fillable = ['name'];
}
