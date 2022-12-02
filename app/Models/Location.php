<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
   protected $table = 'location';
   public function company(){
    return $this->belongsTo(Company::class);
   }
   public function postjob(){
      return $this->belongsTo(PostJob::class, 'location_id', 'id');
     }
}
