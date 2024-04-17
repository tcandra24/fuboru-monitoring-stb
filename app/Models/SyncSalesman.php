<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncSalesman extends Model
{
    use HasFactory;
    protected $connection= 'mysql_sync';
    protected $primaryKey = 'KodeID';
    protected $table = 'Pengguna';
    protected $keyType = 'string';
}
