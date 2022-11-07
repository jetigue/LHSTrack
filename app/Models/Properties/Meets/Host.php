<?php

namespace App\Models\Properties\Meets;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'hosts';

    protected $fillable = ['name'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function path(): string
    {
        return '/meet-hosts/'.$this->slug;
    }
}
