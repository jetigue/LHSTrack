<?php

namespace App\Models\Properties\Events;

use App\Models\Athletes\Athlete;
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
        return $this->hasMany(TrackEvent::class, 'event_category_id');
    }

//    public function athletes(): hasMany
//    {
//        return $this->hasMany(Athlete::class);
//    }
}
