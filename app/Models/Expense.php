<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'expense_number',
        'category_id',
        'department_id',
        'description',
        'amount',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];



    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expense) {
            $expense->expense_number = 'EXP-' . date('Y') . '-' . str_pad(static::count() + 1, 3, '0', STR_PAD_LEFT);
        });
    }

    // app/Models/Expense.php

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id'); // Explicitly specify the foreign key
    }
}
