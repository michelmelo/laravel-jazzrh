<?php

namespace MichelMelo\JazzRh\Models;

class Activity extends BaseModel
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'status',
        'priority',
        'user_id',
        'job_id',
        'applicant_id',
        'due_date',
        'completed_at',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user associated with the activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job associated with the activity.
     */
    public function job()
    {
        return $this->belongsTo(Job::class)->withTrashed();
    }

    /**
     * Get the applicant associated with the activity.
     */
    public function applicant()
    {
        return $this->belongsTo(Applicant::class)->withTrashed();
    }
}
