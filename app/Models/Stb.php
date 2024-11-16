<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stb extends Model
{
    use HasFactory;

    protected $connection= 'mysql_sync';
    protected $primaryKey = 'kodenota';
    protected $table = 'STB';
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'is_insert',
    ];
}
