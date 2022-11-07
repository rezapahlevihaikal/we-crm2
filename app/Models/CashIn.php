<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashIn extends Model
{
    use HasFactory;

    protected $table = 'cash_in';

    protected $fillable = 
    [
        'inv_id',
        'cash_in_date',
        'author_id',
        'nominal_cash_in',
        'nominal_ppn',
        'nominal_pph',
        'file',
        'bank_penerima',
        'deskripsi'
    ];

    public function getInvoice()
    {
        return $this->belongsTo('App\Models\Invoice', 'inv_id', 'id');
    }

    public function getUser()
    {
        return $this->hasOne('App\Models\User', 'author_id', 'id');
    }
}
