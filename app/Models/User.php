<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'email',
            'password',
            'status',
            'user_type_id'
        ];

    public function userDetail() {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }

    public function company() {
        return $this->hasOne(Company::class, 'user_id', 'id');
    }
}
