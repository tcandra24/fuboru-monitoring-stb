<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStb extends Model
{
    use HasFactory;

    protected $table = 'detail_stb';
    protected $primaryKey = 'nomer_kontrak';

    public $timestamps = false;

    protected $fillable = [
        'nomer_kontrak',
        'tahun',
        'bulan',
        'omset',
        'total',
        'persentase',
    ];

    public function masterStb()
    {
        return $this->belongsTo(MasterStb::class, 'nomer_kontrak', 'nomer_kontrak');
    }
}
