<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExamPresenceModel extends Model
{
    use HasFactory;

    protected $table = 'exam_presences';
    protected $primaryKey = 'exam_presences_id';

    protected $fillable = [
        'exam_presences_participant',
        'exam_presences_participant_list',
        'exam_presences_group_id',
        'exam_presences_status',
        'exam_presences_date',
        'exam_presences_learning_id',
        'exam_presences_user_created_by',
        'exam_presences_user_updated_by',
    ];

    const CREATED_AT = 'exam_presences_created_at';
    const UPDATED_AT = 'exam_presences_updated_at';

    public function get_agent_count(){ 
        $temp =  DB::select(
            "   select  exam_presences_participant_list
                from exam_presences, plannings, learnings
                WHERE learnings_id = plannings_learning_id
                AND exam_presences_learning_id = plannings_id
                AND learnings_status != -1   
                AND plannings_status = 1 
                AND exam_presences_status = 1   
            ");
            if(count($temp) > 0){
                $count = 0;
                foreach($temp as $value)
                    $count += count(json_decode($value->exam_presences_participant_list));
                return $count; 
            }else{
                return 0;
            }

    }
    public function get_certify_count(){ 
        $temp =  DB::select(
            "   select  certifications_participant_list
                from certifications, learnings
                WHERE learnings_id = certifications_learnings_id
                AND learnings_status != -1   
                AND certifications_status = 1   
            ");

            if(count($temp) > 0){
                $count = 0;
                foreach($temp as $value)
                    $count += count(json_decode($value->certifications_participant_list));
                return $count; 
            }else{
                return 0;
            }

    }

    public function get_evaluated_agent_count(){ 
        $temp =  DB::select(
            "   select  certifications_participant
                from certifications, learnings
                WHERE learnings_id = certifications_learnings_id
                AND learnings_status != -1   
                AND certifications_status = 1   
            ");

            if(count($temp) > 0){
                $count = 0;
                foreach($temp as $value)
                    $count += count(json_decode($value->certifications_participant));
                return $count; 
            }else{
                return 0;
            }

    }

    //ALL LEARNING THAT HAS PRESENCE
    public function get_learning_count(){ 
        return  DB::select(
            "   select  COUNT(DISTINCT learnings_id ) as learning_count
                from exam_presences, plannings, learnings
                WHERE learnings_id = plannings_learning_id
                AND exam_presences_learning_id = plannings_id
                AND learnings_status != -1   
                AND plannings_status = 1 
                AND exam_presences_status = 1   
            ")[0]->learning_count;

    }
   

    //rate queries
    public function get_certif_rate(){ 
        $temp =  DB::select(
            "   select  learnings_id,learnings_code,learnings_title,learnings_title2,learnings_goal,learnings_target,learnings_duration,learnings_infos, IFNULL(SUM(JSON_LENGTH(exam_presences_participant)),0) as exam_total_participant,  IFNULL(SUM(JSON_LENGTH(exam_presences_participant_list)),0) as exam_total_presence
                from learnings 
                LEFT JOIN exam_presences ON learnings_id = exam_presences_learning_id

                AND learnings_status != -1   
                AND exam_presences_status != -1   

                GROUP BY learnings_id,learnings_code,learnings_title,learnings_title2,learnings_goal,learnings_target,learnings_duration,learnings_infos
            ");

           return $temp;


    }


    //rate queries
    public function get_global_execution_rate(){ 
        $temp =  DB::select(
            "   select  IFNULL(SUM(JSON_LENGTH(exam_presences_participant)),0) as total_participant, IFNULL(SUM(JSON_LENGTH(exam_presences_participant_list)),0) as total_presence
                from learnings 
                LEFT JOIN plannings ON learnings_id = plannings_learning_id
                LEFT JOIN exam_presences ON plannings_id = exam_presences_learning_id

                AND learnings_status != -1   
                AND plannings_status != -1 
                AND exam_presences_status != -1   

            ");

           return $temp;
    }

    public function get_global_learning_processing_rate(){ 
        return  DB::select(
            "   select  COUNT(DISTINCT learnings_id ) as learning_count
                from plannings, learnings
                WHERE learnings_id = plannings_learning_id
                AND learnings_status != -1   
                AND plannings_status = 1 
            ")[0]->learning_count;

    }

     //ALL LEARNING THAT HAS PRESENCE
 

    public function get_global_certification_presence_count(){ 
        $temp =  DB::select(
            "   select  IFNULL(SUM(JSON_LENGTH(exam_presences_participant)),0) as exam_total_participant, IFNULL(SUM(JSON_LENGTH(exam_presences_participant_list)),0) as exam_total_presence
                from learnings 
                LEFT JOIN exam_presences ON learnings_id = exam_presences_learning_id

                AND learnings_status != -1   
                AND exam_presences_status != -1   

            ");

           return $temp;
    }
}
