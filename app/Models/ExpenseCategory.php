<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ExpenseCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    // app/Models/ExpenseCategory.php
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'category_id'); // Explicitly specify the foreign key
    }
}
