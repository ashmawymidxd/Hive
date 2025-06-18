<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'completed',
        'completed_at',
        'staff_id'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}