<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeCost extends Model
{
    use HasFactory;

    protected $table = 'tipe_cost';

    protected $fillable = [
        'nama'
    ];

    public $timestamps = false;
}
