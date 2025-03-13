<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ComplaintAttachment; // ✅ Import this!

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'drugstore_name',
        'complaint_type',
        'incident_date',
        'priority',
        'description',
        'status',
        'user_id'
    ];

    protected $casts = [
        'incident_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(ComplaintAttachment::class);
    }
}
