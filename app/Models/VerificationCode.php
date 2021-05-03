<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class VerificationCode extends Model
{
    use HasFactory;

    public $timestamps = ['created_at'];
    const UPDATED_AT = null;

    protected $fillable = [
        'code',
        'email',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function boot()
    {
        static::creating(function ($model) {
            $model->attributes['code'] = bin2hex(random_bytes(4));
            $model->attributes['expires_at'] = now()->addMinutes(15);
            $model->attributes['status'] = 'unused';
        });

        static::created(function ($model) {
            Mail::to($model->email)->queue(new \App\Mail\VerificationCode($model));
        });

        parent::boot();
    }
}
