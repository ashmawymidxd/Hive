<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['name', 'description'];

    // app/Models/ExpenseCategory.php
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'category_id'); // Explicitly specify the foreign key
    }
}
