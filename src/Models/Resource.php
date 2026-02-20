<?php

namespace MichelMelo\JazzRh\Models;

class Resource extends BaseModel
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'quantity',
        'cost',
        'status',
        'location',
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Get the files associated with the resource.
     */
    public function files()
    {
        return $this->hasMany(File::class, 'resource_id');
    }
}
