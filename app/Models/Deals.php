<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    use HasFactory;

    protected $table = 'deals';

    protected $fillable = 
    [
        'name',
        'author',
        'id_core_bisnis',
        'id_company',
        'size',
        'ppn',
        'start_date',
        'end_date',
        'expired_date',
        'id_source',
        'id_stage',
        'id_product',
        'invoice_number',
        'description'
    ];

    public function getCoreBisnis()
    {
        return $this->belongsTo('App\Models\CoreBisnis', 'id_core_bisnis', 'id');
    }

    public function getCompany()
    {
        return $this->belongsTo('App\Models\Companies', 'id_company', 'id');
    }

    public function getSource()
    {
        return $this->belongsTo('App\Models\Source', 'id_source', 'id');
    }

    public function getStage()
    {
        return $this->belongsTo('App\Models\Stages', 'id_stage', 'id');
    }

    public function getProduct()
    {
        return $this->belongsTo('App\Models\Product', 'id_product', 'id');
    }
}
