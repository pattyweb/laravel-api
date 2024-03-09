<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class HolidayPlan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'location', 'participants'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    protected static function booted(): void
    {
        static::creating(function ($holidayPlan) {
            $holidayPlan->creator_id = Auth::id();
        });
    }
}
