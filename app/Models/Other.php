<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;
    protected $primaryKey = 'other_id';
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
