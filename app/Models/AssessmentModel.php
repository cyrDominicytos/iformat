<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssessmentModel extends Model
{
    use HasFactory;

    protected $table = 'evaluations';
    protected $primaryKey = 'evaluations_id ';

    protected $fillable = [
        'evaluations_learning_id',
        'evaluations_user_id',
        'evaluations_goal_mark',
        'evaluations_progression_mark',
        'evaluations_method_mark',
        'evaluations_material_condition_mark',
        'evaluations_satisfaction_mark',
        'evaluations_time_managment_mark',
        'evaluations_relational_climat_mark',
        'evaluations_support_mark',
        'evaluations_b1',
        'evaluations_b2',
        'evaluations_b3',
        'evaluations_b4',
        'evaluations_b5',
        'evaluations_c1',
        'evaluations_d1',
    ];

    const CREATED_AT = 'evaluations_created_at';
    const UPDATED_AT = 'evaluations_updated_at';

  

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

     //Teacher evaluation list
    public function get_teachers_learnings_assessments($teacher, $learning){ 
             return DB::select(
                 "select 
                 ((evaluations_goal_mark +evaluations_progression_mark+ evaluations_method_mark + evaluations_material_condition_mark+ evaluations_satisfaction_mark+ evaluations_time_managment_mark + evaluations_relational_climat_mark + evaluations_support_mark) / 8)  as a, 
                 ((evaluations_b1+ evaluations_b2 + evaluations_b3 +evaluations_b4 + evaluations_b5)/5) as b, 
                 evaluations_c1, evaluations_d1,evaluations_created_at, evaluations_updated_at, users.*
                 FROM evaluations, learnings, users

                 WHERE  learnings_id = evaluations_learning_id
                 AND users.id =evaluations_user_id
                 AND evaluations_learning_id =".$learning."
                 AND learnings_status != -1 
                 AND evaluations_learning_id IN (
                    SELECT plannings_learning_id FROM plannings
                    WHERE plannings_status = 1 
                    AND JSON_SEARCH(plannings_teachers, 'all', '".$teacher."', NULL ) IS NOT NULL 
                 )");
 
     }
     // evaluation list
    public function get_learnings_assessments_all($learning){ 
             return DB::select(
                 "select 
                 ((evaluations_goal_mark +evaluations_progression_mark+ evaluations_method_mark + evaluations_material_condition_mark+ evaluations_satisfaction_mark+ evaluations_time_managment_mark + evaluations_relational_climat_mark + evaluations_support_mark) / 8)  as a, 
                 ((evaluations_b1+ evaluations_b2 + evaluations_b3 +evaluations_b4 + evaluations_b5)/5) as b, 
                 evaluations_c1, evaluations_d1,evaluations_created_at, evaluations_updated_at, users.*
                 FROM evaluations, learnings, users

                 WHERE  learnings_id = evaluations_learning_id
                 AND users.id =evaluations_user_id
                 AND evaluations_learning_id =".$learning."
                 AND learnings_status != -1 
                ");
 
     }
 
}
