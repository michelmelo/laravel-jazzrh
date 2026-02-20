# API Documentation

## Overview

The JazzRH package provides a complete RESTful API for managing HR operations. All endpoints return JSON responses and follow REST conventions.

## Base URL

```
http://localhost:8000/api/v1
```

## Authentication

Currently, authentication is not enforced at the package level. It's recommended to add authentication middleware in your application:

```php
// In routes/api.php or config/jazzrh.php
'middleware' => ['api', 'auth:sanctum'],
```

## Response Format

All responses follow this format:

### Success Response
```json
{
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2026-02-20T10:00:00Z",
    "updated_at": "2026-02-20T10:00:00Z"
  }
}
```

### Error Response
```json
{
  "message": "The resource was not found",
  "status": 404
}
```

## Pagination

List endpoints support pagination with these parameters:

```
GET /api/v1/users?page=1&per_page=15
```

Response:
```json
{
  "data": [ ... ],
  "links": {
    "first": "http://localhost:8000/api/v1/users?page=1",
    "last": "http://localhost:8000/api/v1/users?page=3",
    "prev": null,
    "next": "http://localhost:8000/api/v1/users?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 3,
    "per_page": 15,
    "to": 15,
    "total": 45
  }
}
```

## Users Endpoints

### List Users
Create, read, update, and delete users.

```
GET /api/v1/users
```

**Query Parameters:**
- `page` (int) - Page number
- `per_page` (int) - Items per page (default: 15)

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "1234567890",
      "cpf": "123.456.789-00",
      "role": "recruiter",
      "status": "active",
      "created_at": "2026-02-20T10:00:00Z",
      "updated_at": "2026-02-20T10:00:00Z"
    }
  ]
}
```

### Create User
```
POST /api/v1/users
```

**Request Body:**
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "secure_password_123",
  "password_confirmation": "secure_password_123",
  "phone": "9876543210",
  "cpf": "987.654.321-00",
  "role": "manager"
}
```

**Response:** `201 Created`

### Get User
```
GET /api/v1/users/{id}
```

**Response:**
```json
{
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "1234567890",
    "cpf": "123.456.789-00",
    "role": "recruiter",
    "status": "active",
    "created_at": "2026-02-20T10:00:00Z",
    "updated_at": "2026-02-20T10:00:00Z"
  }
}
```

### Update User
```
PUT /api/v1/users/{id}
```

**Request Body:**
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "phone": "9876543210",
  "role": "manager"
}
```

### Delete User
```
DELETE /api/v1/users/{id}
```

**Response:** `204 No Content`

## Jobs Endpoints

### List Jobs
```
GET /api/v1/jobs
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "title": "Senior Developer",
      "description": "We are looking for...",
      "category_id": 1,
      "location": "São Paulo, SP",
      "salary_min": "8000.00",
      "salary_max": "15000.00",
      "contract_type": "clt",
      "seniority_level": "senior",
      "status": "published",
      "posted_at": "2026-02-20T10:00:00Z",
      "closes_at": "2026-03-20T10:00:00Z",
      "created_at": "2026-02-20T10:00:00Z",
      "updated_at": "2026-02-20T10:00:00Z"
    }
  ]
}
```

### Create Job
```
POST /api/v1/jobs
```

**Request Body:**
```json
{
  "title": "Senior Developer",
  "description": "Detailed job description...",
  "category_id": 1,
  "location": "São Paulo, SP",
  "salary_min": 8000,
  "salary_max": 15000,
  "contract_type": "clt",
  "seniority_level": "senior",
  "status": "published",
  "closes_at": "2026-03-20"
}
```

### Get Active Jobs
```
GET /api/v1/jobs/active
```

Returns only published jobs that haven't closed yet.

### Get Jobs by Category
```
GET /api/v1/jobs/category/{categoryId}
```

### Get Job
```
GET /api/v1/jobs/{id}
```

### Update Job
```
PUT /api/v1/jobs/{id}
```

### Delete Job
```
DELETE /api/v1/jobs/{id}
```

## Applicants Endpoints

### List Applicants
```
GET /api/v1/applicants
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Maria Silva",
      "email": "maria@example.com",
      "phone": "1234567890",
      "cpf": "123.456.789-00",
      "birth_date": "1990-01-15",
      "address": "Rua A, 123",
      "city": "São Paulo",
      "state": "SP",
      "zip_code": "01234-567",
      "linkedin": "https://linkedin.com/in/mariasilva",
      "portfolio": "https://mariasilva.com",
      "status": "new",
      "score": 85.5,
      "created_at": "2026-02-20T10:00:00Z",
      "updated_at": "2026-02-20T10:00:00Z"
    }
  ]
}
```

### Create Applicant
```
POST /api/v1/applicants
```

**Request Body:**
```json
{
  "name": "Maria Silva",
  "email": "maria@example.com",
  "phone": "1234567890",
  "cpf": "123.456.789-00",
  "birth_date": "1990-01-15",
  "address": "Rua A, 123",
  "city": "São Paulo",
  "state": "SP",
  "zip_code": "01234-567",
  "linkedin": "https://linkedin.com/in/mariasilva",
  "portfolio": "https://mariasilva.com"
}
```

### Get Applicant
```
GET /api/v1/applicants/{id}
```

### Update Applicant
```
PUT /api/v1/applicants/{id}
```

### Delete Applicant
```
DELETE /api/v1/applicants/{id}
```

### Get Applicants by Job
```
GET /api/v1/applicants/job/{jobId}
```

Returns applicants who have applied for a specific job.

### Search Applicants
```
GET /api/v1/applicants/search/{search}
```

Searches applicants by name or email.

**Example:**
```
GET /api/v1/applicants/search/Maria
```

## Status Codes

- `200 OK` - Successful GET, PUT
- `201 Created` - Successful POST
- `204 No Content` - Successful DELETE
- `400 Bad Request` - Invalid request data
- `404 Not Found` - Resource not found
- `422 Unprocessable Entity` - Validation error
- `500 Internal Server Error` - Server error

## Error Responses

### Validation Error
```
POST /api/v1/users
Response: 422 Unprocessable Entity
```

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."],
    "password": ["The password must be at least 8 characters."]
  }
}
```

### Not Found Error
```
GET /api/v1/users/999
Response: 404 Not Found
```

```json
{
  "message": "User not found",
  "status": 404
}
```

## Rate Limiting

To enable rate limiting, add to your middleware configuration:

```php
'middleware' => ['api', 'throttle:60,1'],
```

This limits requests to 60 per minute.

## CORS

If your frontend is on a different domain, enable CORS:

```php
// In config/jazzrh.php
'middleware' => ['api', 'cors'],
```

## Filtering and Sorting

Most endpoints support filtering and sorting:

```
GET /api/v1/jobs?status=published&sort=-created_at

GET /api/v1/applicants?status=new&sort=name
```

## Batch Operations

Some endpoints support batch operations:

```
POST /api/v1/applicants/job/1/apply
```

Request:
```json
{
  "applicant_ids": [1, 2, 3]
}
```

## File Uploads

When handling file uploads, use multipart/form-data:

```bash
curl -X POST http://localhost:8000/api/v1/files \
  -F "file=@/path/to/resume.pdf" \
  -F "name=Resume" \
  -F "type=resume"
```

## Webhooks

Webhooks can be configured to receive notifications for events:

```
- user.created
- user.updated
- user.deleted
- job.created
- job.published
- job.closed
- applicant.created
- applicant.updated
- applicant.status_changed
```

## API Versioning

The current API version is `v1`. Future versions will be available at:

```
/api/v2 (when released)
/api/v3 (when released)
```

## Additional Resources

- [Laravel API Documentation](https://laravel.com/docs/api-documentation)
- [RESTful API Best Practices](https://restfulapi.net/)
- [HTTP Status Codes](https://httpwg.org/specs/rfc7231.html#status.codes)
