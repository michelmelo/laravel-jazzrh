# Installation Guide for JazzRH Package

## Prerequisites

- PHP 8.3 or higher
- Laravel 12.x
- Composer

## Step-by-Step Installation

### 1. Install via Composer

```bash
composer require michelmelo/laravel-jazzrh
```

### 2. Publish Configuration (Optional)

If you need to customize the package configuration:

```bash
php artisan vendor:publish --tag=jazzrh-config
```

This will create a `config/jazzrh.php` file where you can customize:
- Table names
- Model classes
- API prefixes and middleware

### 3. Publish and Run Migrations

```bash
php artisan vendor:publish --tag=jazzrh-migrations
```

Then run:

```bash
php artisan migrate
```

This will create all the necessary tables for the JazzRH system.

### 4. Configure Your Application

Update your `config/jazzrh.php` if needed (optional):

```php
return [
    'api' => [
        'prefix' => 'api/v1',
        'middleware' => ['api'],
    ],
    // ... other configurations
];
```

### 5. Verify Installation

You can verify the installation by checking if the API routes are available:

```bash
php artisan route:list | grep api/v1
```

## Usage After Installation

### Using Services

```php
use MichelMelo\JazzRh\Services\UserService;
use MichelMelo\JazzRh\Services\JobService;

public function __construct(UserService $userService, JobService $jobService)
{
    $this->userService = $userService;
    $this->jobService = $jobService;
}

public function listUsers()
{
    return $this->userService->getAllUsers();
}
```

### Using Facades

```php
use MichelMelo\JazzRh\Facades\JazzRh;

$users = JazzRh::users()->getAllUsers();
$jobs = JazzRh::jobs()->getActiveJobs();
$applicants = JazzRh::applicants()->searchApplicants('John');
```

### Using Models

```php
use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Models\Job;
use MichelMelo\JazzRh\Models\Applicant;

$user = User::find(1);
$jobs = Job::where('status', 'published')->get();
$applicants = Applicant::where('status', 'new')->get();
```

## Testing

To run the package tests:

```bash
php artisan tinker
# or
vendor/bin/pest
```

## Troubleshooting

### Issue: Migrations not found

If migrations are not being discovered, ensure they were published:

```bash
php artisan vendor:publish --tag=jazzrh-migrations
```

### Issue: Routes not available

Ensure the service provider is registered in your `config/app.php`:

```php
'providers' => [
    // ... other providers
    MichelMelo\JazzRh\Providers\JazzRhServiceProvider::class,
],
```

### Issue: Configuration not loading

Clear your configuration cache:

```bash
php artisan config:clear
```

## Next Steps

- Review the [README.md](README.md) for API documentation
- Check the [Configuration Guide](./CONFIGURATION.md) for advanced setup
- Read the [Examples](./EXAMPLES.md) for common use cases

## Support

For issues or questions:
- Open an issue on GitHub
- Email: eu@michelmelo.pt
- Check the documentation in the `docs/` directory
