<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function getCompany()
    {
        return $this->belongsTo('App\Models\Companies', 'id_company', 'id');
    }
}
