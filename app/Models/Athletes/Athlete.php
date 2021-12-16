<?php

namespace App\Models\Athletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Athlete extends Model
{
    use HasFactory;

    protected $dates = ['dob'];

    protected $appends = ['full_name'];

    protected $fillable = [
        'first_name',
        'last_name',
        'sex',
        'grad_year',
        'status',
        'dob',
        'user_id'
    ];

    public function path(): string
    {
        return '/athletes/' . $this->slug;
    }

    public function getDobForEditingAttribute()
    {
        return $this->dob->format('m/d/Y');
    }

    public function scopeFilter($query)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->where('last_name', 'like', '%' . $search . '%')
                ->orWhere('first_name', 'like', '%' . $search . '%');
        });
    }

    /**
     * Save a slug on store and update.
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($athlete) {
            $athlete->slug = Str::slug(
                $athlete->first_name .
                    '-' .
                    $athlete->last_name .
                    '-' .
                    $athlete->grad_year
            );
        });
    }

    public function getFullNameAttribute(): string
    {
        return $this->last_name . ', ' . $this->first_name;
    }

    public function getStatusColorAttribute(): string
    {
        return [
            'a' => 'green',
            'i' => 'gray'
        ][$this->status] ?? 'gray';
    }

    public function getCurrentStatusAttribute(): string
    {
        return [
            'a' => 'Active',
            'i' => 'Inactive'
        ][$this->status] ?? 'Undeclared';
    }

    public function getBirthdateForHumansAttribute(): string
    {
        if ($this->dob) {
            return $this->dob->format('Y-m-d') == '-0001-11-30'
                ? ''
                : $this->dob->format('M d, Y');
        } else {
            return '';
        }
    }
}
