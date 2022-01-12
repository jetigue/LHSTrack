<?php

namespace App\Models\Properties\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table='event_categories';

    protected $fillable = ['name'];

    public function trackEvents(): HasMany
    {
        return $this->hasMany(TrackEvent::class);
    }
}
