<?php

namespace MichelMelo\JazzRh\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;

class User extends BaseModel implements AuthenticatableContract
{
    use Authenticatable, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'cpf',
        'role',
        'status',
        'avatar',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'password' => 'hashed',
        'last_login_at' => 'datetime',
    ];

    /**
     * Get the activities for the user.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id');
    }

    /**
     * Get the tasks assigned to the user.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    /**
     * Get the contacts created by the user.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'user_id');
    }

    /**
     * Get the notes created by the user.
     */
    public function notes()
    {
        return $this->hasMany(Note::class, 'user_id');
    }
}
