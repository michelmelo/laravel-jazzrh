<?php

namespace MichelMelo\JazzRh\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use MichelMelo\JazzRh\Models\Job;
use MichelMelo\JazzRh\Repositories\JobRepository;

class JobService
{
    public function __construct(
        protected JobRepository $repository
    ) {}

    /**
     * Get all jobs with pagination.
     */
    public function getAllJobs(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Get active jobs.
     */
    public function getActiveJobs(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->getActive($perPage);
    }

    /**
     * Get job by ID.
     */
    public function getJobById(int $id): ?Job
    {
        return $this->repository->findById($id);
    }

    /**
     * Create a new job.
     */
    public function createJob(array $data): Job
    {
        return $this->repository->create($data);
    }

    /**
     * Update a job.
     */
    public function updateJob(int $id, array $data): Job
    {
        $job = $this->repository->findById($id);

        if (! $job) {
            throw new \Exception('Job not found');
        }

        $this->repository->update($job, $data);

        return $job->fresh();
    }

    /**
     * Delete a job.
     */
    public function deleteJob(int $id): bool
    {
        $job = $this->repository->findById($id);

        if (! $job) {
            throw new \Exception('Job not found');
        }

        return $this->repository->delete($job);
    }

    /**
     * Get jobs by category.
     */
    public function getJobsByCategory(int $categoryId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->getByCategory($categoryId, $perPage);
    }
}
