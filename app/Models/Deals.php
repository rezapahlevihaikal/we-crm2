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
        'id_author',
        'id_core_bisnis',
        'id_company',
        'size',
        'amount_po',
        'ppn',
        'pph_23',
        'start_date',
        'end_date',
        'expired_date',
        'no_faktur_pajak',
        'priority_id',
        'id_source',
        'file',
        'id_stage',
        'id_product',
        'invoice_number',
        'description'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'id_author', 'id');
    }

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

    public function getPriority()
    {
        return $this->belongsTo('App\Models\Priority', 'priority_id', 'id');
    }

    public function getStatusPpn()
    {
        return $this->belongsTo('App\Models\StatusTax', 'ppn', 'id');
    }

    public function getStatusPph()
    {
        return $this->belongsTo('App\Models\StatusPph', 'pph_23', 'value');
    }
}
