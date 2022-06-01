<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CertificationModel extends Model
{
    use HasFactory;

    protected $table = 'certifications';
    protected $primaryKey = 'certifications_id';

    protected $fillable = [
        'certifications_code',
        'certifications_participant',
        'certifications_participant_list',
        'certifications_group_id',
        'certifications_learnings_id',
        'certifications_status',
        'certifications_user_created_by',
        'certifications_user_updated_by',
    ];

    const CREATED_AT = 'certifications_created_at';
    const UPDATED_AT = 'certifications_updated_at';

  

   
}
