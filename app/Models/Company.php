<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
   protected $table = 'company';
   public function posts()
   {
    return $this->belongsTo(Post::class);
   }
   public function locations(){
      return $this->belongsTo(Location::class);
   }
}

