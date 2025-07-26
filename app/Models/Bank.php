<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
     protected $fillable = [
        'name',
        'slug',
        'type',
        'annual_rate',
        'rate_type',
        'min_amount',
        'max_amount',
        'min_months',
        'max_months',
        'logo',
    ];

    /**
     * Boot method to auto-generate slug on create or update if not set.
     */
    protected static function booted()
    {
        static::creating(function ($bank) {
            if (!$bank->slug) {
                $bank->slug = Str::slug($bank->name);
            }
        });

        static::updating(function ($bank) {
            if (!$bank->slug) {
                $bank->slug = Str::slug($bank->name);
            }
        });
    }

    /**
     * Get initials from bank name for logo fallback.
     */
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';

        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return $initials;
    }
}
