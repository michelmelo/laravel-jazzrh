<?php

namespace MichelMelo\JazzRh\Models;

class Task extends BaseModel
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'assigned_to',
        'user_id',
        'due_date',
        'completed_at',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user who assigned the task.
     */
    public function assigner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user assigned to the task.
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Check if the task is completed.
     */
    public function isCompleted(): bool
    {
        return ! is_null($this->completed_at);
    }

    /**
     * Mark the task as completed.
     */
    public function markAsCompleted(): bool
    {
        return $this->update(['completed_at' => now()]);
    }

    /**
     * Mark the task as incomplete.
     */
    public function markAsIncomplete(): bool
    {
        return $this->update(['completed_at' => null]);
    }
}
