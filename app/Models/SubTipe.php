<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTipe extends Model
{
    use HasFactory;

    protected $table = 'subtipe_cost';

    protected $fillable = [
        'name',
        'tipe_id'
    ];

    public $timestamps = false;

    public function getTipeCost()
    {
        return $this->belongsTo('App\Models\TipeCost', 'tipe_id', 'id');
    }
}
