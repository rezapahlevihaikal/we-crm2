<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable =
    [
        'deals_id',
        'inv_date',
        'exp_inv_date',
        'billed_value',
        'faktur_pajak',
        'ppn',
        'inv_status_id',
        'pic_inv',
        'inv_number',
        'company_id',
        'inv_desc'
    ];

    public function getDeals()
    {
        return $this->belongsTo('App\Models\Deals', 'id_deals', 'id');
    }

    public function getCompany()
    {
        return $this->belongsTo('App\Models\Companies', 'company_id', 'id');
    }
}
