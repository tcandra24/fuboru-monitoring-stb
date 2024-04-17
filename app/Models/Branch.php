<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'cabang';
    protected $primaryKey = 'kode';
    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function stb()
    {
        return $this->hasMany(MasterStb::class, 'kode_area', 'kode');
    }

    public function customer()
    {
        return $this->hasMany(Customer::class, 'kode_area', 'kode');
    }

    public function getNamaAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = strtolower($value);
    }
}
