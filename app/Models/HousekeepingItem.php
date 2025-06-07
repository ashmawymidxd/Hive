<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousekeepingItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'name', 'category', 'quantity', 'unit', 'status', 
    'notes', 'reorder_point', 'priority', 'needs_restock'
];

protected static function boot()
{
    parent::boot();

    static::saving(function ($item) {
        // Update status based on quantity
        $item->status = $item->calculateStatus();
        
        // Determine if needs restock
        $item->needs_restock = $item->quantity <= $item->reorder_point;
        
        // Set priority based on how far below reorder point we are
        if ($item->needs_restock) {
            $percentage = ($item->quantity / $item->reorder_point) * 100;
            if ($percentage < 30) {
                $item->priority = 'High';
            } elseif ($percentage < 60) {
                $item->priority = 'Medium';
            } else {
                $item->priority = 'Low';
            }
        } else {
            $item->priority = 'None';
        }
    });
}

public function calculateStatus()
{
    if ($this->quantity <= 0) {
        return 'Out of Stock';
    } elseif ($this->quantity <= $this->reorder_point) {
        return 'Reorder Needed';
    } elseif ($this->quantity <= ($this->reorder_point * 2)) {
        return 'Adequate';
    } else {
        return 'Well Stocked';
    }
}
}
