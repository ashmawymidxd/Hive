<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'staff_id',
        'assigned_by',
        'due_date',
        'status',
        'priority'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function assigner()
    {
        return $this->belongsTo(Staff::class, 'assigned_by');
    }
}
