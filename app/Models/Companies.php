<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'company_name',
        'author',
        'phone_number_company',
        'address',
        'zipcode',
        'website',
        'nama_dirut',
        'note_1',
        'note_2',
        'note_3'
    ];
}
