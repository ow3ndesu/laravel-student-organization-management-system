<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_id',
        'renewal_letter',
        'accomplishment_report',
        'budgetary_eport',
        'submitted_at',
        'administrator_id',
        'modified_at'
    ];
}
