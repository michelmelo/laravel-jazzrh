<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\Categories2Applicants;
use MichelMelo\JazzRh\Resources\Categories2ApplicantsResource;
use Illuminate\Http\Request;

class Categories2ApplicantsController extends Controller
{
    public function index(): JsonResponse
    {
        $items = Categories2Applicants::all();
        return response()->json(Categories2ApplicantsResource::collection($items));
    }

    public function show(int $id): JsonResponse
    {
        $item = Categories2Applicants::findOrFail($id);
        return response()->json(new Categories2ApplicantsResource($item));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'applicant_id' => 'required|integer|exists:applicants,id',
        ]);
        $item = Categories2Applicants::create($data);
        return response()->json(new Categories2ApplicantsResource($item), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = Categories2Applicants::findOrFail($id);
        $data = $request->validate([
            'category_id' => 'sometimes|integer|exists:categories,id',
            'applicant_id' => 'sometimes|integer|exists:applicants,id',
        ]);
        $item->update($data);
        return response()->json(new Categories2ApplicantsResource($item));
    }

    public function destroy(int $id): JsonResponse
    {
        $item = Categories2Applicants::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
