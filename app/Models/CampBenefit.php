<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampBenefit extends Model
{
    use HasFactory;

    protected $filable = ['camp_id', 'name']; // yang bisa diisi hanya name dan camp_id
}
