<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
   protected $table = 'post_job'; 
   protected $fillable = ['id','job_title','company_id','job_type_id','job_location_id','job_salary_min','job_description','job_salary_max'];
   public function company()
   {
    return $this->hasOne(Company::class, 'id' , 'company_id');
   }
   public function location(){
      return $this->hasOne(Location::class, 'id' , 'location_id');
   }
   public function wishlist(){
      return $this->hasOne(WishList::class,'post_job_id','id');
  }
  public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
