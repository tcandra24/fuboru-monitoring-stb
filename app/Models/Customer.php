<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $primaryKey = 'kode';
    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'kota',
        'kode_pos',
        'kecamatan',
        'kelurahan',
        'telepon',
        'kode_divisi',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'kode_pelanggan', 'kode');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'kode_divisi', 'kode');
    }

    public function stb()
    {
        return $this->hasMany(MasterStb::class, 'kode_pelanggan', 'kode');
    }
}
