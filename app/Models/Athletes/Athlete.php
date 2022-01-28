<?php

namespace App\Models\Athletes;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Athlete extends Model
{
    use HasFactory;

    protected $dates = ['dob', 'physical_expiration_date'];

    protected $appends = ['full_name'];

    protected $fillable = [
        'first_name',
        'last_name',
        'sex',
        'grad_year',
        'status',
        'dob',
        'user_id',
        'track_event_subtype_id',
        'physical_expiration_date'
    ];

    public function path(): string
    {
        return '/athletes/' . $this->slug;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function primaryTrackEvent(): BelongsTo
    {
        return $this->belongsTo(TrackEventSubtype::class, 'track_event_subtype_id');
    }

    public function getDobForEditingAttribute()
    {
        return $this->dob->format('m/d/Y');
    }

    public function getPhysicalExpirationDateForEditingAttribute()
    {
        if ($this->physical_expiration_date) {
            return $this->physical_expiration_date->format('m/d/Y');
        }
    }

    public function scopeFilter($query)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->where('last_name', 'like', '%' . $search . '%')
                ->orWhere('first_name', 'like', '%' . $search . '%');
        });

        $query->when($filters['status'] ?? false, fn($query, $status) =>
            $query->whereHas('status', fn ($query) =>
                $query->where('status', $status)
            )
        );

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
            'i' => 'gray',
            'e' => 'red'
        ][$this->status] ?? 'gray';
    }

    public function getSexForHumansAttribute(): string
    {
        return [
            'm' => 'Male',
            'f' => 'Female'
        ][$this->sex] ?? '';
    }

    public function getCurrentStatusAttribute(): string
    {
        return [
            'a' => 'Active',
            'i' => 'Inactive',
            'e' => 'Ineligible'
        ][$this->status] ?? 'Undeclared';
    }

    public function getBirthdateForHumansAttribute(): string
    {
        if ($this->dob) {
            return $this->dob->format('Y-m-d') == '-0001-11-30'
                ? ''
                : $this->dob->format('n-d-Y');
        } else {
            return '';
        }
    }

    public function getPhysicalExpirationDateForHumansAttribute()
    {
        if ($this->physical_expiration_date) {
            return $this->physical_expiration_date->format('M d, Y');
        }
    }

    public function getGradeAttribute()
    {
        $m = Carbon::now()->month;
        $y = Carbon::now()->year;
        $gy = $this->grad_year;

        switch($m)
        {
            case $m >= 6:
                if ($gy - $y === 5)
                { return '8th grade'; }

                else if ($gy - $y === 4)
                { return '9th grade'; }

                elseif ($gy - $y === 3)
                { return '10th grade'; }

                elseif ($gy - $y === 2)
                { return '11th grade'; }

                elseif ($gy - $y === 1)
                { return '12th grade'; }

                elseif ($gy - $y <= 0)
                { return 'alum'; }

                else { return ''; }
            case $m <= 5:
                if ($gy - $y === 4)
                { return '8th grade'; }

                elseif ($gy - $y === 3)
                { return '9th grade'; }

                elseif ($gy - $y === 2)
                { return '10th grade'; }

                elseif ($gy - $y === 1)
                { return '11th grade'; }

                elseif ($gy - $y === 0)
                { return '12th grade'; }

                else { return 'alum'; }
        }

    }
}
