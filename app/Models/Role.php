<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'access_level',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array', // Cast permissions to an array
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function staff_count(){
        return $this->staff()->count();
    }

}
