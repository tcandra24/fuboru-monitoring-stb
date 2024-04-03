<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStb extends Model
{
    use HasFactory;

    protected $table = 'master_stb';
    protected $primaryKey = 'nomer_kontrak';

    protected $fillable = [
        'nomer_kontrak',
        'kode_pelanggan',
        'kode_area',
        'kode_salesman',
        'periode_awal',
        'periode_akhir',
        'target_rp',
        'hadiah_persen',
    ];
}
