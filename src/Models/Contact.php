<?php

namespace MichelMelo\JazzRh\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'applicant_id',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\ContactFactory::new();
    }
    public function activities()
    {
        return $this->hasMany(Activity::class, 'contact_id');
    }
}
