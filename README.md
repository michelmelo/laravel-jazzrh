# JazzRH Package for Laravel 12

[![Latest Version on Packagist](https://img.shields.io/packagist/v/michelmelo/laravel-jazzrh.svg?style=flat-square)](https://packagist.org/packages/michelmelo/laravel-jazzrh)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

A comprehensive HR management package for Laravel 12, built with the latest Laravel standards and best practices.

## Features

- 📋 **User Management** - Manage HR team members with different roles
- 💼 **Job Management** - Create, update, and track job openings
- 👥 **Applicant Management** - Manage job applicants and their applications
- 📅 **Activity Tracking** - Log all system activities
- 📝 **Tasks & Notes** - Create tasks and notes for team members
- 📞 **Contact Management** - Manage contacts and relationships
- 📂 **Resource Management** - Track company resources
- 📄 **File Management** - Upload and manage files
- ❓ **Questionnaire System** - Create and manage questionnaires for applicants
- 🎯 **RESTful API** - Complete API endpoints for all features

## Requirements

- PHP ^8.3
- Laravel ^12.0

## Installation

You can install the package via composer:

```bash
composer require michelmelo/laravel-jazzrh
```

### Publishing Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=jazzrh-config
```

### Running Migrations

Publish and run migrations:

```bash
php artisan vendor:publish --tag=jazzrh-migrations
php artisan migrate
```

## Configuration

The configuration file is located at `config/jazzrh.php`. Here you can customize:

- Table names
- Model classes
- API settings
- Features to enable/disable

```php
return [
    'tables' => [
        'users' => 'users',
        'jobs' => 'jobs',
        'applicants' => 'applicants',
        // ... more tables
    ],
    
    'api' => [
        'prefix' => 'api/v1',
        'middleware' => ['api'],
    ],
];
```

## Usage

### Using the Facade

```php
use MichelMelo\JazzRh\Facades\JazzRh;

// Get all users
$users = JazzRh::users()->getAllUsers();

// Get all jobs
$jobs = JazzRh::jobs()->getAllJobs();

// Get all applicants
$applicants = JazzRh::applicants()->getAllApplicants();
```

### Using Services Directly

```php
use MichelMelo\JazzRh\Services\UserService;
use MichelMelo\JazzRh\Services\JobService;
use MichelMelo\JazzRh\Services\ApplicantService;

// Inject the service
public function __construct(UserService $userService)
{
    $this->userService = $userService;
}

// Use the service
$user = $this->userService->getUserById(1);
$users = $this->userService->getAllUsers();
```

## API Endpoints

### Users
```
GET     /api/v1/users              - List all users
POST    /api/v1/users              - Create a new user
GET     /api/v1/users/{id}         - Get a specific user
PUT     /api/v1/users/{id}         - Update a user
DELETE  /api/v1/users/{id}         - Delete a user
```

### Jobs
```
GET     /api/v1/jobs               - List all jobs
POST    /api/v1/jobs               - Create a new job
GET     /api/v1/jobs/{id}          - Get a specific job
PUT     /api/v1/jobs/{id}          - Update a job
DELETE  /api/v1/jobs/{id}          - Delete a job
GET     /api/v1/jobs/active        - List active jobs
GET     /api/v1/jobs/category/{categoryId} - List jobs by category
```

### Applicants
```
GET     /api/v1/applicants         - List all applicants
POST    /api/v1/applicants         - Create a new applicant
GET     /api/v1/applicants/{id}    - Get a specific applicant
PUT     /api/v1/applicants/{id}    - Update an applicant
DELETE  /api/v1/applicants/{id}    - Delete an applicant
GET     /api/v1/applicants/job/{jobId} - List applicants by job
GET     /api/v1/applicants/search/{search} - Search applicants
```

## Models

The package includes the following models:

- `User` - HR team members and users
- `Job` - Job openings
- `Applicant` - Job applicants
- `Activity` - Activity logs
- `Contact` - Contact information
- `Task` - Tasks and assignments
- `Resource` - Company resources
- `Category` - Categories for jobs and applicants
- `File` - File uploads
- `Note` - Notes and memos
- `QuestionnaireQuestion` - Questionnaire questions
- `QuestionnaireAnswer` - Applicant answers to questionnaires

## Validation Rules

### Store User Request
- `name` - Required, string, max 255 characters
- `email` - Required, email, unique
- `password` - Required, string, min 8 characters, confirmed
- `phone` - Optional, string, max 20 characters
- `cpf` - Optional, string, unique
- `role` - Required, one of: admin, manager, recruiter, user

### Store Job Request
- `title` - Required, string, max 255 characters
- `description` - Required, string
- `category_id` - Required, exists in categories table
- `location` - Required, string, max 255 characters
- `salary_min` - Optional, numeric, min 0
- `salary_max` - Optional, numeric, greater than salary_min
- `contract_type` - Required, one of: clt, pj, temporary, internship
- `seniority_level` - Required, one of: junior, mid-level, senior
- `status` - Required, one of: draft, published, closed
- `closes_at` - Optional, date, after now

### Store Applicant Request
- `name` - Required, string, max 255 characters
- `email` - Required, email, unique
- `phone` - Optional, string, max 20 characters
- `cpf` - Optional, string, unique
- `birth_date` - Optional, date, before now
- `address` - Optional, string, max 255 characters
- `city` - Optional, string, max 100 characters
- `state` - Optional, string, max 2 characters
- `zip_code` - Optional, string, max 20 characters
- `linkedin` - Optional, valid URL
- `portfolio` - Optional, valid URL

## Testing

Run the test suite:

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support

For support, email dev@michelmelo.com or open an issue on GitHub.

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for details of what has changed.

## Contributing

Contributions are welcome! Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.
