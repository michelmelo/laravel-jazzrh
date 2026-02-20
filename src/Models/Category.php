<?php

namespace MichelMelo\JazzRh\Models;

class Category extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'color',
        'icon',
        'type',
    ];

    /**
     * Get the jobs in this category.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Get the applicants in this category.
     */
    public function applicants()
    {
        return $this->belongsToMany(
            Applicant::class,
            config('jazzrh.tables.category_applicant'),
            'category_id',
            'applicant_id'
        )->withTimestamps();
    }
}
