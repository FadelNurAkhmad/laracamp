<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'price']; // slug auto created dari title, yg bisa diisi hanya title dan price

    // attribute gabungan user yang sedang login dan camp yg dipilih
    public function getIsRegisteredAttribute()
    {
        if (!Auth::check()) {
            // kalau tidak ada yg login
            return false;
        }

        // kalau ada yg login, mengambil id yg dipilih, dan id dari orang yg lagi login
        return Checkout::whereCampId($this->id)->whereUserId(Auth::id())->exists(); // kalau ada return true kalau tidak false
    }
}
