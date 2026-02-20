<?php

namespace MichelMelo\JazzRh\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories2Applicants extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\Categories2ApplicantsFactory::new();
    }
    use HasFactory;

    protected $table = 'categories2applicants';

    protected $fillable = [
        'category_id',
        'applicant_id',
    ];
}
