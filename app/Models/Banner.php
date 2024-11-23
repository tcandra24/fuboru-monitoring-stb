<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $connection= 'mysql_sync';
    protected $primaryKey = 'KdPlg';
    protected $table = 'Pelanggan_Verifikasi';
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'tglpengiriman',
    ];
}
