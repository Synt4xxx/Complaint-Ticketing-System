<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority', // Ensure priority is also fillable
        'user_id'
    ];

    /**
     * Define relationship: Ticket belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
