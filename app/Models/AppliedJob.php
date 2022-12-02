<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class AppliedJob extends Model
{
    public function companys()
    {
        return $this->belongsTo(Company::class);
    } 
    public function users()
    {
        return $this->hasOne(User::class);
    } 
}
