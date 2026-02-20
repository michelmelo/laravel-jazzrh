<?php

namespace MichelMelo\JazzRh\Facades;

use Illuminate\Support\Facades\Facade;
use MichelMelo\JazzRh\Services\ApplicantService;
use MichelMelo\JazzRh\Services\JobService;
use MichelMelo\JazzRh\Services\UserService;

/**
 * @method static \MichelMelo\JazzRh\Services\UserService users()
 * @method static \MichelMelo\JazzRh\Services\JobService jobs()
 * @method static \MichelMelo\JazzRh\Services\ApplicantService applicants()
 */
class JazzRh extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'jazzrh';
    }

    /**
     * Get the user service.
     */
    public static function users(): UserService
    {
        return app(UserService::class);
    }

    /**
     * Get the job service.
     */
    public static function jobs(): JobService
    {
        return app(JobService::class);
    }

    /**
     * Get the applicant service.
     */
    public static function applicants(): ApplicantService
    {
        return app(ApplicantService::class);
    }
}
