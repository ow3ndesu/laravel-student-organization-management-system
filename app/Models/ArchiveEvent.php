<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'image',
        'name',
        'place',
        'date_time',
        'out',
        'description',
        'status',
        'event_created_at',
        'event_updated_at'
    ];
}
