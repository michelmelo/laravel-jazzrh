<?php

namespace MichelMelo\JazzRh\Models;

class Job extends BaseModel
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'location',
        'salary_min',
        'salary_max',
        'contract_type',
        'seniority_level',
        'status',
        'posted_by',
        'posted_at',
        'closes_at',
    ];

    protected $casts = [
        'posted_at' => 'datetime',
        'closes_at' => 'datetime',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    /**
     * Get the category associated with the job.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user who posted the job.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    /**
     * Get the applicants for the job.
     */
    public function applicants()
    {
        return $this->belongsToMany(
            Applicant::class,
            config('jazzrh.tables.applicant_job'),
            'job_id',
            'applicant_id'
        )->withTimestamps();
    }

    /**
     * Get the activities related to the job.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class, 'job_id');
    }
}
