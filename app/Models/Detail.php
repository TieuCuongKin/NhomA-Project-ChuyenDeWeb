<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $primaryKey = 'detail_id';
    // protected $primaryKey = ['product_id', 'payment_id'];
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
