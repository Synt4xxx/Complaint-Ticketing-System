<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'file_name',
        'complaint_id'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
