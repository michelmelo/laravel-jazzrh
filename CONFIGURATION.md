# Advanced Configuration Guide

## Table Customization

You can customize table names in the configuration file. Edit `config/jazzrh.php`:

```php
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
```

### Example: Using Custom Table Names

If you want to use custom table names:

```php
'tables' => [
    'users' => 'hr_users',
    'jobs' => 'hr_jobs',
    'applicants' => 'hr_applicants',
    // ... customize other tables
],
```

## Model Customization

Extend the models to add custom logic:

```php
namespace App\Models;

use MichelMelo\JazzRh\Models\User as JazzRhUser;

class User extends JazzRhUser
{
    // Add custom methods and relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
```

Then update `config/jazzrh.php`:

```php
'models' => [
    'user' => App\Models\User::class,
    // ... other models
],
```

## API Configuration

### Customize the API Prefix

```php
'api' => [
    'prefix' => 'api/v2',  // Change from v1 to v2
    'middleware' => ['api', 'auth:sanctum'],  // Add authentication
],
```

### Add Route Middleware

```php
'api' => [
    'prefix' => 'api/v1',
    'middleware' => ['api', 'auth:sanctum', 'throttle:60,1'],
],
```

## Feature Flags

Enable or disable specific features:

```php
'features' => [
    'api' => true,           // Enable API endpoints
    'webhooks' => true,      // Enable webhook support
    'notifications' => true, // Enable notifications
],
```

## Database Configuration

The package uses your application's default database connection. Ensure your `.env` is properly configured:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=jazzrh
DB_USERNAME=root
DB_PASSWORD=
```

## Customizing Form Requests

Extend the form requests for custom validation:

```php
namespace App\Http\Requests;

use MichelMelo\JazzRh\Requests\StoreUserRequest as BaseRequest;

class StoreUserRequest extends BaseRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'department_id' => ['required', 'exists:departments,id'],
        ]);
    }
}
```

## API Resource Customization

Extend API resources to customize responses:

```php
namespace App\Http\Resources;

use MichelMelo\JazzRh\Resources\UserResource as BaseResource;

class UserResource extends BaseResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'department' => $this->department,
            'custom_field' => $this->custom_field,
        ]);
    }
}
```

## Service Layer Customization

Create custom services extending package services:

```php
namespace App\Services;

use MichelMelo\JazzRh\Services\UserService as BaseUserService;

class UserService extends BaseUserService
{
    public function createUserWithDepartment(array $data)
    {
        $user = parent::createUser($data);
        // Add custom logic
        return $user;
    }
}
```

## Broadcasting and Events

To enable real-time features, configure broadcasting in your `.env`:

```env
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_HOST=api-eu.pusher.com
PUSHER_PORT=443
PUSHER_SCHEME=https
```

## Cache Configuration

Configure caching for better performance:

```php
// In config/jazzrh.php
'cache' => [
    'enabled' => true,
    'ttl' => 3600, // 1 hour
    'prefix' => 'jazzrh:',
],
```

## Logging

Configure logging for the package:

```php
// In config/logging.php
'channels' => [
    'jazzrh' => [
        'driver' => 'single',
        'path' => storage_path('logs/jazzrh.log'),
        'level' => env('LOG_LEVEL', 'debug'),
    ],
],
```

## Queue Configuration

To process jobs asynchronously:

```env
QUEUE_CONNECTION=database
# or
QUEUE_CONNECTION=redis
```

Start the queue worker:

```bash
php artisan queue:work
```

## Troubleshooting

### Configuration Cache Issues

If changes to configuration aren't reflected:

```bash
php artisan config:clear
```

### Migration Issues

If migrations fail:

```bash
# Rebuild migrations
php artisan migrate:refresh --tag=jazzrh-migrations
```

### Custom Model Not Loading

Ensure your custom model is properly defined in `config/jazzrh.php` and follows Laravel conventions.
