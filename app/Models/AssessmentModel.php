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

  

    public function get_learnings_assessments($teacher){ 
             return DB::select(
                 "select learnings.*, AVG(assessments_value) as mark, COUNT(assessments_id) as total_agent 
                     from assessments, learnings
                     WHERE learnings_id = assessments_learning_id  
                     AND learnings_status != -1   
                     AND learnings_id IN (
                        SELECT plannings_learning_id FROM plannings
                        WHERE plannings_status = 1 
                        AND JSON_SEARCH(plannings_teachers, 'all', '".$teacher."', NULL ) IS NOT NULL 
                     )
                     GROUP BY learnings_id
                 ");
 
     }
 
}
