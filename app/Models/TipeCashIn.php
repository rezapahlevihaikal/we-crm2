<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeCashIn extends Model
{
    use HasFactory;

    protected $table = 'tipe_cash_in';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
