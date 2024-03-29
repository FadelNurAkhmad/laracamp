<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'camp_id', 'card_number', 'expired', 'cvc', 'is_paid'];

    public function setExpiredAttribute($value)
    {
        // ketika ada menyimpan kolom expired maka akan ke parshing dulu biar format sesuai
        $this->attributes['expired'] = date('Y-m-d', strtotime($value));
    }

    
    /**
     * Get the Camp that owns the Checkout
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    // Relasi ke camp
    public function Camp(): BelongsTo
    {
        return $this->belongsTo(Camp::class);
    }

    
    /**
     * Get the user that owns the Checkout
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    // Relasi ke user
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
