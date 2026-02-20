<?php

namespace MichelMelo\JazzRh\Models;

class QuestionnaireQuestion extends BaseModel
{
    protected $fillable = [
        'question',
        'type',
        'options',
        'order',
        'is_required',
        'status',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the answers for this question.
     */
    public function answers()
    {
        return $this->hasMany(QuestionnaireAnswer::class, 'question_id');
    }
}
