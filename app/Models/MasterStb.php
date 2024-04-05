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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'kode_pelanggan', 'kode');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'kode_area', 'kode');
    }

    public function salesman()
    {
        return $this->belongsTo(Salesman::class, 'kode_salesman', 'kode');
    }

    public function detailStb()
    {
        return $this->hasMany(DetailStb::class, 'nomer_kontrak', 'nomer_kontrak');
    }
}
