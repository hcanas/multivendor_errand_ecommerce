<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'roles',
        'status',
        'remarks',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function setRolesAttribute($value)
    {
        $this->attributes['roles'] = implode(',', $value);
    }

    public function getRolesAttribute($value)
    {
        return explode(',', $value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    protected static function boot()
    {
        static::creating(function ($model) {
            $model->attributes['email_verified_at'] = now();
            $model->attributes['roles'] = 'buyer';
            $model->attributes['status'] = 'active';
        });

        parent::boot();
    }
}
