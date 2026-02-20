# Usage Examples

## Basic Usage

### Basic Usage

#### Get All Users
```php
use MichelMelo\JazzRh\Facades\JazzRh;

$users = JazzRh::users()->getAllUsers();
foreach ($users as $user) {
    echo $user->name;
}
```

#### Create a New User
```php
$user = JazzRh::users()->createUser([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => 'secure_password',
    'role' => 'recruiter',
    'phone' => '1234567890',
]);
```

#### Update a User
```php
$user = JazzRh::users()->updateUser(1, [
    'name' => 'Jane Doe',
    'phone' => '9876543210',
]);
```

#### Delete a User
```php
JazzRh::users()->deleteUser(1);
```

### Job Management

#### Get All Jobs
```php
$jobs = JazzRh::jobs()->getAllJobs();
```

#### Get Active Jobs
```php
$activeJobs = JazzRh::jobs()->getActiveJobs();
```

#### Create a Job
```php
$job = JazzRh::jobs()->createJob([
    'title' => 'Senior Developer',
    'description' => 'We are looking for...',
    'category_id' => 1,
    'location' => 'São Paulo, SP',
    'salary_min' => 8000,
    'salary_max' => 15000,
    'contract_type' => 'clt',
    'seniority_level' => 'senior',
    'status' => 'published',
    'posted_by' => auth()->id(),
]);
```

#### Get Jobs by Category
```php
$categoryJobs = JazzRh::jobs()->getJobsByCategory(1);
```

### Applicant Management

#### Get All Applicants
```php
$applicants = JazzRh::applicants()->getAllApplicants();
```

#### Create an Applicant
```php
$applicant = JazzRh::applicants()->createApplicant([
    'name' => 'Maria Silva',
    'email' => 'maria@example.com',
    'phone' => '1234567890',
    'cpf' => '123.456.789-00',
    'birth_date' => '1990-01-15',
    'city' => 'São Paulo',
    'state' => 'SP',
    'linkedin' => 'https://linkedin.com/in/mariasilva',
    'status' => 'new',
]);
```

#### Search Applicants
```php
$results = JazzRh::applicants()->searchApplicants('Maria');
```

#### Get Applicants by Job
```php
$jobApplicants = JazzRh::applicants()->getApplicantsByJob(1);
```

## Advanced Usage

### Using Models Directly

```php
use MichelMelo\JazzRh\Models\Job;
use MichelMelo\JazzRh\Models\Applicant;

// Get job with relationships
$job = Job::with(['applicants', 'activities', 'category'])->find(1);

// Filter applicants by status
$newApplicants = Applicant::where('status', 'new')->get();

// Sort jobs by salary
$jobs = Job::orderBy('salary_max', 'desc')->paginate(15);
```

### Using Services with Dependency Injection

```php
namespace App\Http\Controllers;

use MichelMelo\JazzRh\Services\UserService;
use MichelMelo\JazzRh\Services\JobService;

class DashboardController
{
    public function __construct(
        protected UserService $userService,
        protected JobService $jobService
    ) {}

    public function index()
    {
        $users = $this->userService->getAllUsers();
        $jobs = $this->jobService->getActiveJobs();

        return view('dashboard', [
            'users' => $users,
            'jobs' => $jobs,
        ]);
    }
}
```

### Using Repositories

```php
use MichelMelo\JazzRh\Repositories\UserRepository;
use MichelMelo\JazzRh\Repositories\ApplicantRepository;

class CustomService
{
    public function __construct(
        private UserRepository $userRepo,
        private ApplicantRepository $applicantRepo
    ) {}

    public function getStatistics()
    {
        $activeUsers = $this->userRepo->getActive();
        $newApplicants = $this->applicantRepo->getByStatus('new');

        return [
            'active_users' => $activeUsers,
            'new_applicants' => $newApplicants,
        ];
    }
}
```

### Working with Relationships

```php
use MichelMelo\JazzRh\Models\Job;

// Get a job with all its applicants and activities
$job = Job::with(['applicants', 'activities', 'category', 'creator'])
    ->find(1);

// Add applicants to a job
$job->applicants()->attach($applicantIds);

// Remove an applicant from a job
$job->applicants()->detach($applicantId);

// Get applicants for a job
$applicants = $job->applicants;
```

### Working with Tasks

```php
use MichelMelo\JazzRh\Models\Task;

// Create a task
$task = Task::create([
    'title' => 'Review Applicant',
    'description' => 'Review the resume of...',
    'status' => 'pending',
    'priority' => 'high',
    'assigned_to' => 2,
    'user_id' => auth()->id(),
    'due_date' => now()->addDays(3),
]);

// Mark as completed
$task->markAsCompleted();

// Mark as incomplete
$task->markAsIncomplete();

// Check if completed
if ($task->isCompleted()) {
    echo "Task is completed";
}
```

### Working with Notes

```php
use MichelMelo\JazzRh\Models\Note;

// Create a note for an applicant
$note = Note::create([
    'title' => 'Interview Notes',
    'content' => 'The candidate showed great technical skills...',
    'type' => 'interview',
    'user_id' => auth()->id(),
    'applicant_id' => 1,
    'is_important' => true,
]);

// Get notes for an applicant
$applicantNotes = $applicant->notes;

// Get notes for a job
$jobNotes = $job->notes;
```

### Working with Files

```php
use MichelMelo\JazzRh\Models\File;

// Create a file record
$file = File::create([
    'name' => 'resume_maria_silva.pdf',
    'original_name' => 'resume.pdf',
    'path' => 'resumes/resume_maria_silva.pdf',
    'mime_type' => 'application/pdf',
    'size' => 245678,
    'disk' => 'local',
    'user_id' => auth()->id(),
]);

// Get human-readable file size
echo $file->getHumanSize(); // "240 KB"

// Get full file path
echo $file->getFullPath();
```

## API Examples

### Using the REST API

#### Get All Users
```bash
curl -X GET "http://localhost:8000/api/v1/users" \
  -H "Accept: application/json"
```

#### Create a Job
```bash
curl -X POST "http://localhost:8000/api/v1/jobs" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Senior Developer",
    "description": "We are looking for...",
    "category_id": 1,
    "location": "São Paulo, SP",
    "contract_type": "clt",
    "seniority_level": "senior",
    "status": "published"
  }'
```

#### Get Applicants by Job
```bash
curl -X GET "http://localhost:8000/api/v1/applicants/job/1" \
  -H "Accept: application/json"
```

#### Search Applicants
```bash
curl -X GET "http://localhost:8000/api/v1/applicants/search/Maria" \
  -H "Accept: application/json"
```

## Common Patterns

### Pagination
```php
use MichelMelo\JazzRh\Facades\JazzRh;

// Get paginated users
$users = JazzRh::users()->getAllUsers(20); // 20 items per page

// In controller
return response()->json($users);
```

### Filtering
```php
use MichelMelo\JazzRh\Models\Job;

$jobs = Job::where('status', 'published')
    ->where('seniority_level', 'senior')
    ->paginate(15);
```

### Ordering
```php
use MichelMelo\JazzRh\Models\Applicant;

$applicants = Applicant::orderBy('score', 'desc')
    ->where('status', 'approved')
    ->get();
```

## Error Handling

```php
try {
    $user = JazzRh::users()->getUserById(999);
    if (!$user) {
        throw new \Exception('User not found');
    }
} catch (\Exception $e) {
    return response()->json(['error' => $e->getMessage()], 404);
}
```
