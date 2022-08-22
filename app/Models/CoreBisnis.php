<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreBisnis extends Model
{
    use HasFactory;

    protected $table = 'core_bisnis';

    protected $fillable = [
        'nama_core_bisnis',
        'id_divisi'
    ];

    public function getDivisiCore()
    {
        return $this->belongsTo('App\Models\Divisi', 'id_divisi', 'id');
    }
}
