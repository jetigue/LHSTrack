<?php

namespace App\Models\Properties\Meets\Track;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venue extends Model
{
    use HasFactory;

    protected $table = 'track_venues';
    protected $fillable = ['name', 'track_surface_id'];

    public function surface(): BelongsTo
    {
        return $this->belongsTo(Surface::class, 'track_surface_id');
    }

    public function path(): string
    {
        return '/track/venues/' . $this->slug;
    }
}
