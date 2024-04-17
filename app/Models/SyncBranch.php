<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncBranch extends Model
{
    use HasFactory;

    protected $connection= 'mysql_sync';
    protected $primaryKey = 'Kode';
    protected $table = 'Cabang';
    protected $keyType = 'string';
}
