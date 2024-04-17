<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    use HasFactory;
    protected $table = 'salesman';
    protected $primaryKey = 'kode';
    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'kota',
    ];

    public function stb()
    {
        return $this->hasMany(MasterStb::class, 'kode_salesman', 'kode');
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
