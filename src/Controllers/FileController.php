<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\File;
use MichelMelo\JazzRh\Resources\FileResource;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(): JsonResponse
    {
        $files = File::all();
        return response()->json(FileResource::collection($files));
    }

    public function show(int $id): JsonResponse
    {
        $file = File::findOrFail($id);
        return response()->json(new FileResource($file));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'size' => 'required|integer',
            'applicant_id' => 'nullable|integer|exists:applicants,id',
            'job_id' => 'nullable|integer|exists:jobs,id',
        ]);
        $file = File::create($data);
        return response()->json(new FileResource($file), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $file = File::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'path' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|max:50',
            'size' => 'sometimes|integer',
            'applicant_id' => 'nullable|integer|exists:applicants,id',
            'job_id' => 'nullable|integer|exists:jobs,id',
        ]);
        $file->update($data);
        return response()->json(new FileResource($file));
    }

    public function destroy(int $id): JsonResponse
    {
        $file = File::findOrFail($id);
        $file->delete();
        return response()->json(null, 204);
    }
}
