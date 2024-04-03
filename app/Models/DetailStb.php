<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStb extends Model
{
    use HasFactory;

    protected $table = 'detail_stb';

    public $timestamps = false;

    protected $fillable = [
        'nomer_kontrak',
        'tahun',
        'bulan',
        'omset',
        'total',
        'persentase',
    ];
}
