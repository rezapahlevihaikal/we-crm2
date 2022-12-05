<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashOut extends Model
{
    use HasFactory;

    protected $table = 'cash_outs';

    protected $fillable = [
        'status_data',
        'subtipe_id',
        'tanggal_transaksi',
        'nominal',
        'dibayarkan_kepada',
        'ket_pembayaran',
        'keterangan',
        'pic_id',
        'product_id',
        'core_bisnis_id',
        'file'
    ];

    public function getTipeCost()
    {
        return $this->belongsTo('App\Models\TipeCost', 'tipe_id', 'id');
    }

    public function getSubTipe()
    {
        return $this->belongsTo('App\Models\SubTipe', 'subtipe_id', 'id');
    }

    public function getProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function getCoreBisnis()
    {
        return $this->belongsTo('App\Models\CoreBisnis', 'core_bisnis_id', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'pic_id', 'id');
    }
}
