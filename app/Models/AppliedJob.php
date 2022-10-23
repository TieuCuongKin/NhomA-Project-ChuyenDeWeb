<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class AppliedJob extends Model
{
    public function getJob()
    {
        return $this->belongsTo(Company::class);
    } 
    public function userJob()
    {
        return $this->hasOne(User::class);
    } 
}
