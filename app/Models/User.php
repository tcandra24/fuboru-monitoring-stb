<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'pengguna';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_pelanggan',
        'kode_area',
        'nama',
        'email',
        'password',
        'valid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPermissionArray()
    {
        return $this->getAllPermissions()->mapWithKeys(function($pr){
            return [$pr['name'] => true];
        });
    }

    public function getNamaAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = strtolower($value);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'kode', 'kode_pelanggan');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'kode_area', 'kode');
    }
}
