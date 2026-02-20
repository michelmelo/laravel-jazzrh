<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Requests\StoreUserRequest;
use MichelMelo\JazzRh\Requests\UpdateUserRequest;
use MichelMelo\JazzRh\Resources\UserResource;
use MichelMelo\JazzRh\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {}

    /**
     * Display a listing of users.
     */
    public function index(): JsonResponse
    {
        $users = $this->service->getAllUsers();

        return response()->json(UserResource::collection($users));
    }

    /**
     * Store a newly created user.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->service->createUser($request->validated());

        return response()->json(new UserResource($user), 201);
    }

    /**
     * Display the specified user.
     */
    public function show(int $id): JsonResponse
    {
        $user = $this->service->getUserById($id);

        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(new UserResource($user));
    }

    /**
     * Update the specified user.
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            $user = $this->service->updateUser($id, $request->validated());

            return response()->json(new UserResource($user));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified user.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->deleteUser($id);

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
