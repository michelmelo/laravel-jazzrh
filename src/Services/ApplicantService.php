<?php

namespace MichelMelo\JazzRh\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Repositories\ApplicantRepository;

class ApplicantService
{
    public function __construct(
        protected ApplicantRepository $repository
    ) {}

    /**
     * Get all applicants with pagination.
     */
    public function getAllApplicants(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Get applicant by ID.
     */
    public function getApplicantById(int $id): ?Applicant
    {
        return $this->repository->findById($id);
    }

    /**
     * Create a new applicant.
     */
    public function createApplicant(array $data): Applicant
    {
        return $this->repository->create($data);
    }

    /**
     * Update an applicant.
     */
    public function updateApplicant(int $id, array $data): Applicant
    {
        $applicant = $this->repository->findById($id);

        if (! $applicant) {
            throw new \Exception('Applicant not found');
        }

        $this->repository->update($applicant, $data);

        return $applicant->fresh();
    }

    /**
     * Delete an applicant.
     */
    public function deleteApplicant(int $id): bool
    {
        $applicant = $this->repository->findById($id);

        if (! $applicant) {
            throw new \Exception('Applicant not found');
        }

        return $this->repository->delete($applicant);
    }

    /**
     * Get applicants by job.
     */
    public function getApplicantsByJob(int $jobId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->getByJob($jobId, $perPage);
    }

    /**
     * Search applicants.
     */
    public function searchApplicants(string $search, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->search($search, $perPage);
    }
}
