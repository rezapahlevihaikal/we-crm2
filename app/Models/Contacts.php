<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = 
    [
        'name',
        'author',
        'id_author',
        'phone_number',
        'email',
        'id_company',
        'address',
        'id_divisi',
        'id_core_bisnis',
        'note'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'id_author', 'id');
    }

    public function getCompany()
    {
        return $this->belongsTo('App\Models\Companies', 'id_company', 'id');
    }

    public function getCoreBisnis()
    {
        return $this->belongsTo('App\Models\CoreBisnis', 'id_core_bisnis', 'id');
    }

    public function getDivisi()
    {
        return $this->belongsTo('App\Models\Divisi', 'id_divisi', 'id', 'nama_divisi');
    }
}
