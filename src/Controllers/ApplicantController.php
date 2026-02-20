<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Requests\StoreApplicantRequest;
use MichelMelo\JazzRh\Resources\ApplicantResource;
use MichelMelo\JazzRh\Services\ApplicantService;

class ApplicantController extends Controller
{
    public function __construct(
        protected ApplicantService $service
    ) {}

    /**
     * Display a listing of applicants.
     */
    public function index(): JsonResponse
    {
        $applicants = $this->service->getAllApplicants();

        return response()->json(ApplicantResource::collection($applicants));
    }

    /**
     * Store a newly created applicant.
     */
    public function store(StoreApplicantRequest $request): JsonResponse
    {
        $applicant = $this->service->createApplicant($request->validated());

        return response()->json(new ApplicantResource($applicant), 201);
    }

    /**
     * Display the specified applicant.
     */
    public function show(int $id): JsonResponse
    {
        $applicant = $this->service->getApplicantById($id);

        if (! $applicant) {
            return response()->json(['message' => 'Applicant not found'], 404);
        }

        return response()->json(new ApplicantResource($applicant));
    }

    /**
     * Update the specified applicant.
     */
    public function update(StoreApplicantRequest $request, int $id): JsonResponse
    {
        try {
            $applicant = $this->service->updateApplicant($id, $request->validated());

            return response()->json(new ApplicantResource($applicant));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified applicant.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->deleteApplicant($id);

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Get applicants by job.
     */
    public function getByJob(int $jobId): JsonResponse
    {
        $applicants = $this->service->getApplicantsByJob($jobId);

        return response()->json(ApplicantResource::collection($applicants));
    }

    /**
     * Search applicants.
     */
    public function search(string $search): JsonResponse
    {
        $applicants = $this->service->searchApplicants($search);

        return response()->json(ApplicantResource::collection($applicants));
    }
}
