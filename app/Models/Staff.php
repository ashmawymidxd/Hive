<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'role_id',
        'email',
        'phone',
        'status',
        'hire_date',
        'password',
        'remember_token',
        'password_changed_at',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'hire_date' => 'date',
        'status' => 'string',
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name . ' ' . $this->last_name,
        );
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

     public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
