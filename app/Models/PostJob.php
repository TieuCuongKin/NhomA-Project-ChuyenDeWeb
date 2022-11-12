<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
   protected $table = 'post_job';
   public function company()
   {
    return $this->hasOne(AppliedJob::class);
   }
}
