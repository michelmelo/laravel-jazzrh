<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Names
    |--------------------------------------------------------------------------
    |
    | Define the table names used by the JazzRH package.
    |
    */
    'tables' => [
        'users' => 'users',
        'jobs' => 'jobs',
        'applicants' => 'applicants',
        'activities' => 'activities',
        'contacts' => 'contacts',
        'tasks' => 'tasks',
        'resources' => 'resources',
        'categories' => 'categories',
        'files' => 'files',
        'notes' => 'notes',
        'questionnaire_questions' => 'questionnaire_questions',
        'questionnaire_answers' => 'questionnaire_answers',
        'applicant_job' => 'applicants_jobs',
        'category_applicant' => 'categories_applicants',
    ],

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | Define custom model classes for the JazzRH package.
    |
    */
    'models' => [
        'user' => \MichelMelo\JazzRh\Models\User::class,
        'job' => \MichelMelo\JazzRh\Models\Job::class,
        'applicant' => \MichelMelo\JazzRh\Models\Applicant::class,
        'activity' => \MichelMelo\JazzRh\Models\Activity::class,
        'contact' => \MichelMelo\JazzRh\Models\Contact::class,
        'task' => \MichelMelo\JazzRh\Models\Task::class,
        'resource' => \MichelMelo\JazzRh\Models\Resource::class,
        'category' => \MichelMelo\JazzRh\Models\Category::class,
        'file' => \MichelMelo\JazzRh\Models\File::class,
        'note' => \MichelMelo\JazzRh\Models\Note::class,
        'questionnaire_question' => \MichelMelo\JazzRh\Models\QuestionnaireQuestion::class,
        'questionnaire_answer' => \MichelMelo\JazzRh\Models\QuestionnaireAnswer::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | API Configuration
    |--------------------------------------------------------------------------
    |
    | API-related settings for the JazzRH package.
    |
    */
    'api' => [
        'prefix' => 'api/v1',
        'middleware' => ['api'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Enable or disable specific features of the JazzRH package.
    |
    */
    'features' => [
        'api' => true,
        'webhooks' => false,
        'notifications' => true,
    ],
];
