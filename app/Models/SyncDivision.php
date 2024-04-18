<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncDivision extends Model
{
    use HasFactory;

    protected $connection= 'mysql_sync';
    protected $primaryKey = 'kode';
    protected $table = 'divisi';
    protected $keyType = 'string';
}
