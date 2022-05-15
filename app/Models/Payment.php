<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'payment_id';
    public function details()
    {
        return $this->hasMany(Detail::class, 'payment_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
