<?php

namespace MichelMelo\JazzRh\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use MichelMelo\JazzRh\Models\User;

class UserRepository
{
    public function __construct(
        protected User $model
    ) {}

    /**
     * Get all users with pagination.
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Find user by ID.
     */
    public function findById(int $id): ?User
    {
        return $this->model->find($id);
    }

    /**
     * Find user by email.
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Create a new user.
     */
    public function create(array $data): User
    {
        return $this->model->create($data);
    }

    /**
     * Update a user.
     */
    public function update(User $user, array $data): void
    {
        $user->update($data);
    }

    /**
     * Delete a user.
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }

    /**
     * Get active users.
     */
    public function getActive(int $perPage = 15): Paginator
    {
        return $this->model
            ->where('status', 'active')
            ->paginate($perPage);
    }
}
