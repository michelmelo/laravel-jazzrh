<?php

namespace MichelMelo\JazzRh\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Repositories\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $repository
    ) {}

    /**
     * Get all users with pagination.
     */
    public function getAllUsers(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Get user by ID.
     */
    public function getUserById(int $id): ?User
    {
        return $this->repository->findById($id);
    }

    /**
     * Create a new user.
     */
    public function createUser(array $data): User
    {
        return $this->repository->create($data);
    }

    /**
     * Update a user.
     */
    public function updateUser(int $id, array $data): User
    {
        $user = $this->repository->findById($id);

        if (! $user) {
            throw new \Exception('User not found');
        }

        $this->repository->update($user, $data);

        return $user->fresh();
    }

    /**
     * Delete a user.
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->repository->findById($id);

        if (! $user) {
            throw new \Exception('User not found');
        }

        return $this->repository->delete($user);
    }

    /**
     * Get user by email.
     */
    public function getUserByEmail(string $email): ?User
    {
        return $this->repository->findByEmail($email);
    }
}
