<?php

namespace App\Models\Properties\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrackEvent extends Model
{
    use HasFactory;

    protected $table = 'track_events';

    protected $fillable = ['name', 'event_category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'event_category_id');
    }
}
