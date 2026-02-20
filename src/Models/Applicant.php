<?php

namespace MichelMelo\JazzRh\Models;

class Applicant extends BaseModel
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'cpf',
        'birth_date',
        'address',
        'city',
        'state',
        'zip_code',
        'linkedin',
        'portfolio',
        'resume_file_id',
        'status',
        'score',
        'notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'score' => 'float',
    ];

    /**
     * Get the resume file for the applicant.
     */
    public function resumeFile()
    {
        return $this->belongsTo(File::class, 'resume_file_id');
    }

    /**
     * Get the jobs the applicant has applied for.
     */
    public function jobs()
    {
        return $this->belongsToMany(
            Job::class,
            config('jazzrh.tables.applicant_job'),
            'applicant_id',
            'job_id'
        )->withTimestamps();
    }

    /**
     * Get the categories the applicant belongs to.
     */
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            config('jazzrh.tables.category_applicant'),
            'applicant_id',
            'category_id'
        )->withTimestamps();
    }

    /**
     * Get the activities related to the applicant.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class, 'applicant_id');
    }

    /**
     * Get the questionnaire answers for the applicant.
     */
    public function questionnaireAnswers()
    {
        return $this->hasMany(QuestionnaireAnswer::class, 'applicant_id');
    }
}
