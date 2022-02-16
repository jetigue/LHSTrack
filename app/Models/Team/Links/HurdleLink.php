<?php

namespace App\Models\Team\Links;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HurdleLink extends Model
{
    use HasFactory;

    protected $table = 'hurdle_links';

    protected $fillable = ['url', 'text', 'user_id'];

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
