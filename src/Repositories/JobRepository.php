<?php

namespace MichelMelo\JazzRh\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use MichelMelo\JazzRh\Models\Job;

class JobRepository
{
    public function __construct(
        protected Job $model
    ) {}

    /**
     * Get all jobs with pagination.
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Find job by ID.
     */
    public function findById(int $id): ?Job
    {
        return $this->model->find($id);
    }

    /**
     * Create a new job.
     */
    public function create(array $data): Job
    {
        return $this->model->create($data);
    }

    /**
     * Update a job.
     */
    public function update(Job $job, array $data): void
    {
        $job->update($data);
    }

    /**
     * Delete a job.
     */
    public function delete(Job $job): bool
    {
        return $job->delete();
    }

    /**
     * Get active jobs.
     */
    public function getActive(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->where('status', 'published')
            ->whereDate('closes_at', '>=', now())
            ->paginate($perPage);
    }

    /**
     * Get jobs by category.
     */
    public function getByCategory(int $categoryId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->where('category_id', $categoryId)
            ->paginate($perPage);
    }
}
