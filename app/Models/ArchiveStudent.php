<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'type',
        'remember_token',
        'student_created_at',
        'student_updated_at'
    ];
}
