<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_id',
        'application_form',
        'advisers_commitment_form',
        'submitted_at',
        'administrator_id',
        'modified_at'
    ];
}
