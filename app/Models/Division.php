<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisi';
    protected $primaryKey = 'kode';
    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'kode_divisi', 'kode');
    }
}
