<?php

namespace MichelMelo\JazzRh\Traits;

trait HasTimestamps
{
    /**
     * Get the created_at attribute.
     */
    public function getCreatedAtAttribute($value)
    {
        return $value ? $value->format('Y-m-d H:i:s') : null;
    }

    /**
     * Get the updated_at attribute.
     */
    public function getUpdatedAtAttribute($value)
    {
        return $value ? $value->format('Y-m-d H:i:s') : null;
    }
}
