<?php
namespace MichelMelo\JazzRh\Models;

class QuestionnaireAnswer extends BaseModel
{
    protected static function newFactory()
    {
        return \Database\Factories\QuestionnaireAnswerFactory::new();
    }

    protected $fillable = [
        'question_id',
        'applicant_id',
        'answer',
    ];


    /**
     * Get the question associated with the answer.
     */
    public function question()
    {
        return $this->belongsTo(QuestionnaireQuestion::class, 'question_id');
    }

    /**
     * Get the applicant associated with the answer.
     */
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
