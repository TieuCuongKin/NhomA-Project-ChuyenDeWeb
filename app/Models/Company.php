<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
   protected $table = 'company';
   public function postjob()
   {
    return $this->belongsTo(PostJob::class, 'company_id' , 'id');
   }
   public function locations(){
      return $this->belongsTo(Location::class);
   }
   public function comments()
   {
       return $this->hasMany(Comment::class);
   }
}

