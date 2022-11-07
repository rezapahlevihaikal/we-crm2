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
        'amount_po',
        'inv_date',
        'exp_inv_date',
        'billed_value',
        'faktur_pajak',
        'author',
        'sales_code',
        'no_order',
        'based_value',
        'ppn',
        'pph_23',
        'ppn_id',
        'pph_id',
        'size',
        'product_id',
        'address_npwp',
        'inv_status_id',
        'pic_inv',
        'inv_number',
        'company_id',
        'inv_desc',
        'receipt_number',
        'tf_number'
    ];

    public function getDeals()
    {
        return $this->belongsTo('App\Models\Deals', 'deals_id', 'id');
    }

    public function getCompany()
    {
        return $this->belongsTo('App\Models\Companies', 'company_id', 'id');
    }

    public function getProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function getStatus()
    {
        return $this->belongsTo('App\Models\InvStatus', 'inv_status_id', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'author', 'id');
    }

    public function getStatusPph()
    {
        return $this->belongsTo('App\Models\StatusPph', 'pph_id', 'id');
    }

    public function getStatusPpn()
    {
        return $this->belongsTo('App\Models\StatusTax', 'ppn_id', 'id');
    }
}
