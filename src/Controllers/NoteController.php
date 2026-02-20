<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\Note;
use MichelMelo\JazzRh\Resources\NoteResource;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(): JsonResponse
    {
        $notes = Note::all();
        return response()->json(NoteResource::collection($notes));
    }

    public function show(int $id): JsonResponse
    {
        $note = Note::findOrFail($id);
        return response()->json(new NoteResource($note));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'applicant_id' => 'nullable|integer|exists:applicants,id',
            'job_id' => 'nullable|integer|exists:jobs,id',
        ]);
        $note = Note::create($data);
        return response()->json(new NoteResource($note), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $note = Note::findOrFail($id);
        $data = $request->validate([
            'content' => 'sometimes|string',
            'user_id' => 'sometimes|integer|exists:users,id',
            'applicant_id' => 'nullable|integer|exists:applicants,id',
            'job_id' => 'nullable|integer|exists:jobs,id',
        ]);
        $note->update($data);
        return response()->json(new NoteResource($note));
    }

    public function destroy(int $id): JsonResponse
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return response()->json(null, 204);
    }
}
