<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\Task;
use MichelMelo\JazzRh\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Task::query();
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
        $tasks = $query->get();
        return response()->json(TaskResource::collection($tasks));
    }

    public function show(int $id): JsonResponse
    {
        $task = Task::findOrFail($id);
        return response()->json(new TaskResource($task));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'priority' => 'nullable|string',
            'assigned_to' => 'required|integer|exists:users,id',
            'user_id' => 'required|integer|exists:users,id',
            'due_date' => 'nullable|date',
            'completed_at' => 'nullable|date',
        ]);
        $task = Task::create($data);
        return response()->json(new TaskResource($task), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $task = Task::findOrFail($id);
        $data = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'priority' => 'nullable|string',
            'assigned_to' => 'sometimes|integer|exists:users,id',
            'user_id' => 'sometimes|integer|exists:users,id',
            'due_date' => 'nullable|date',
            'completed_at' => 'nullable|date',
        ]);
        $task->update($data);
        return response()->json(new TaskResource($task));
    }

    public function destroy(int $id): JsonResponse
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
