<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssessmentModel extends Model
{
    use HasFactory;

    protected $table = 'assessments';
    protected $primaryKey = 'assessments_id';

    protected $fillable = [
        'assessments_learning_id',
        'assessments_participant_id',
        'assessments_value',
    ];

    const CREATED_AT = 'assessments_created_at';
    const UPDATED_AT = 'assessments_updated_at';

  

   
}
