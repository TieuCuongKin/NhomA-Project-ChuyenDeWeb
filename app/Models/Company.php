<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'user_id',
            'company_name',
            'company_address',
            'company_contact',
            'company_website',
            'description',
            'image',
        ];
    public function products()
    {
        return $this->hasMany(Product::class, 'company_name');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
