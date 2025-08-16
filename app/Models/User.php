<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'phone',
        'password',
        'user_type_id',
        'fullname',
        'address',
        'city',
        'state',
        'country',
        'zipcode',
        'is_verified',
        'government_id',
        'government_id_type',
        'is_active',
        'created_by',
    ];

    protected $hidden = ['password'];

    public $timestamps = false;

    const CREATED_AT = 'created_datetime';
    const UPDATED_AT = 'updated_datetime';
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            // Only update wg_id after the user is inserted and id is available
            $user->wg_id = 'WG00' . $user->id;
            $user->saveQuietly(); // Avoid infinite loop by not triggering model events again
        });
    }
}
