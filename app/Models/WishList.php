<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wishlist';
    public $primaryKey='id';
    protected $fillable = ['id','customer_id','post_job_id'];
    public $timestamps = false;
    function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function postjob(){
        return $this->hasOne(PostJob::class,'id','post_job_id');
    }
}
