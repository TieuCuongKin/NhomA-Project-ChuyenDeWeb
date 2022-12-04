<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'full_name',
            'gender',
            'address',
            'phone',
            'user_id',
        ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
