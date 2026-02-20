<?php

namespace MichelMelo\JazzRh\Traits;

use MichelMelo\JazzRh\Models\Activity;

trait LogsActivity
{
    /**
     * Boot the LogsActivity trait.
     */
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            $model->logActivity('created', "Created {$model->getTable()} record");
        });

        static::updated(function ($model) {
            $model->logActivity('updated', "Updated {$model->getTable()} record");
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted', "Deleted {$model->getTable()} record");
        });
    }

    /**
     * Log an activity.
     */
    public function logActivity(string $type, string $description): Activity
    {
        return Activity::create([
            'title' => ucfirst($type),
            'description' => $description,
            'type' => $type,
            'status' => 'completed',
            'priority' => 'low',
            'user_id' => auth()->id() ?? 1,
            'completed_at' => now(),
        ]);
    }
}
