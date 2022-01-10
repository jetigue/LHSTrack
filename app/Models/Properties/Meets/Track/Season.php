<?php

namespace App\Models\Properties\Meets\Track;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $table = 'track_seasons';
    protected $fillable = ['name'];
}
