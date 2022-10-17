<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTipe extends Model
{
    use HasFactory;

    protected $table = 'subtipe_cost';

    public function getTipeCost()
    {
        return $this->belongsTo('App\Models\TipeCost', 'tipe_id', 'id');
    }
}
