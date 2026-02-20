<?php

namespace MichelMelo\JazzRh\Models;

class Applicants2Jobs extends BaseModel
{
    protected $table = 'applicants2jobs';

    protected $fillable = [
        'applicant_id',
        'job_id',
        'status',
        'applied_at',
        'hired_at',
    ];

    protected $dates = [
        'applied_at',
        'hired_at',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
