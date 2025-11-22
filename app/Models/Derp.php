<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Derp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'desc',
        'cor_x',
        'cor_y',
        'cor_z'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
