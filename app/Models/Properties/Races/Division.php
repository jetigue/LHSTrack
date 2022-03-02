<?php

namespace App\Models\Properties\Races;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Division extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'divisions';

    protected $fillable = ['gender_id', 'level_id' ];

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function getNameAttribute(): string
    {
        return $this->gender->name . ' ' . $this->level->name;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['gender.name',  'level.name']
            ]
        ];
    }
}
