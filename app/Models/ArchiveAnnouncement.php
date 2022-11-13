<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveAnnouncement extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'user_id',
        'title',
        'announcement',
        'status',
        'announcement_created_at',
        'announcement_updated_at'
    ];
}
