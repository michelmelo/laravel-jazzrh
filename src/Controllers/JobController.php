<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Requests\StoreJobRequest;
use MichelMelo\JazzRh\Resources\JobResource;
use MichelMelo\JazzRh\Services\JobService;

class JobController extends Controller
{
    public function __construct(
        protected JobService $service
    ) {}

    /**
     * Display a listing of jobs.
     */
    public function index(): JsonResponse
    {
        $jobs = $this->service->getAllJobs();

        return response()->json(JobResource::collection($jobs));
    }

    /**
     * Display a listing of active jobs.
     */
    public function active(): JsonResponse
    {
        $jobs = $this->service->getActiveJobs();

        return response()->json(JobResource::collection($jobs));
    }

    /**
     * Store a newly created job.
     */
    public function store(StoreJobRequest $request): JsonResponse
    {
        $job = $this->service->createJob($request->validated());

        return response()->json(new JobResource($job), 201);
    }

    /**
     * Display the specified job.
     */
    public function show(int $id): JsonResponse
    {
        $job = $this->service->getJobById($id);

        if (! $job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        return response()->json(new JobResource($job));
    }

    /**
     * Update the specified job.
     */
    public function update(StoreJobRequest $request, int $id): JsonResponse
    {
        try {
            $job = $this->service->updateJob($id, $request->validated());

            return response()->json(new JobResource($job));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified job.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->deleteJob($id);

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Get jobs by category.
     */
    public function getByCategory(int $categoryId): JsonResponse
    {
        $jobs = $this->service->getJobsByCategory($categoryId);

        return response()->json(JobResource::collection($jobs));
    }
}
