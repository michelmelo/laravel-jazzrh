<?php

namespace MichelMelo\JazzRh\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use MichelMelo\JazzRh\Models\Applicant;

class ApplicantRepository
{
    public function __construct(
        protected Applicant $model
    ) {}

    /**
     * Get all applicants with pagination.
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Find applicant by ID.
     */
    public function findById(int $id): ?Applicant
    {
        return $this->model->find($id);
    }

    /**
     * Create a new applicant.
     */
    public function create(array $data): Applicant
    {
        return $this->model->create($data);
    }

    /**
     * Update an applicant.
     */
    public function update(Applicant $applicant, array $data): void
    {
        $applicant->update($data);
    }

    /**
     * Delete an applicant.
     */
    public function delete(Applicant $applicant): bool
    {
        return $applicant->delete();
    }

    /**
     * Get applicants by job.
     */
    public function getByJob(int $jobId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->whereHas('jobs', function ($query) use ($jobId) {
                $query->where('job_id', $jobId);
            })
            ->paginate($perPage);
    }

    /**
     * Search applicants by name or email.
     */
    public function search(string $search, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->paginate($perPage);
    }

    /**
     * Get applicants by status.
     */
    public function getByStatus(string $status, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->where('status', $status)
            ->paginate($perPage);
    }
}
