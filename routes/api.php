<?php

use Illuminate\Support\Facades\Route;
use MichelMelo\JazzRh\Controllers\ActivityController;
use MichelMelo\JazzRh\Controllers\ApplicantController;
use MichelMelo\JazzRh\Controllers\JobController;
use MichelMelo\JazzRh\Controllers\UserController;
use MichelMelo\JazzRh\Controllers\CategoryController;

Route::prefix(config('jazzrh.api.prefix', 'api/v1'))
    ->middleware(config('jazzrh.api.middleware', ['api']))
    ->group(function () {
        // Users endpoints
        Route::apiResource('users', UserController::class);

        // Jobs endpoints
        Route::apiResource('jobs', JobController::class);
        Route::get('jobs/active', [JobController::class, 'active'])->name('jobs.active');
        Route::get('jobs/category/{categoryId}', [JobController::class, 'getByCategory'])->name('jobs.category');

        // Applicants endpoints
        Route::apiResource('applicants', ApplicantController::class);
        Route::get('applicants/job/{jobId}', [ApplicantController::class, 'getByJob'])->name('applicants.job');
        Route::get('applicants/search/{search}', [ApplicantController::class, 'search'])->name('applicants.search');

        // Activities endpoints
        Route::apiResource('activities', ActivityController::class);

        // Categories endpoints
        Route::apiResource('categories', CategoryController::class);

        // Applicants2Jobs endpoints
        Route::apiResource('applicants2jobs', \MichelMelo\JazzRh\Controllers\ApplicantsToJobsController::class);

        // Categories2Applicants endpoints
        Route::apiResource('categories2applicants', \MichelMelo\JazzRh\Controllers\Categories2ApplicantsController::class);

        // Contacts endpoints

        // QuestionnaireQuestions endpoints
        Route::apiResource('questionnaire_questions', \MichelMelo\JazzRh\Controllers\QuestionnaireQuestionController::class);

        // Tasks endpoints
        Route::apiResource('tasks', \MichelMelo\JazzRh\Controllers\TaskController::class);
        Route::apiResource('contacts', \MichelMelo\JazzRh\Controllers\ContactController::class);

        // Files endpoints
        Route::apiResource('files', \MichelMelo\JazzRh\Controllers\FileController::class);

        // Notes endpoints
        Route::apiResource('notes', \MichelMelo\JazzRh\Controllers\NoteController::class);

        // QuestionnaireAnswers endpoints
        Route::apiResource('questionnaire_answers', \MichelMelo\JazzRh\Controllers\QuestionnaireAnswerController::class);
    });
