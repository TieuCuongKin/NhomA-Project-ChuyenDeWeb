<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    use HasFactory;

    protected $table = 'post_job';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'job_title',
            'company_id',
            'job_location_id',
            'job_salary_min',
            'job_salary_max',
            'job_description',
            'job_expired_at',
            'job_status'
        ];

    public function location() {
        return $this->belongsTo(Location::class, 'job_location_id', 'id');
    }

    public function company() {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
