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
        'kode_area',
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

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'kode_area', 'kode');
    }

    public function getNamaAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = strtolower($value);
    }

    public function getAlamatAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getKotaAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function setKotaAttribute($value)
    {
        $this->attributes['kota'] = strtolower($value);
    }

    public function getKecamatanAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function setKecamatanAttribute($value)
    {
        $this->attributes['kecamatan'] = strtolower($value);
    }

    public function getKelurahanAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function setKelurahanAttribute($value)
    {
        $this->attributes['kelurahan'] = strtolower($value);
    }


}
