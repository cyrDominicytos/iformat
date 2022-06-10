<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PresenceModel extends Model
{
    use HasFactory;

    protected $table = 'presences';
    protected $primaryKey = 'presences_id';

    protected $fillable = [
        'presences_code',
        'presences_time_slot',
        'presences_participant',
        'presences_participant_list',
        'presences_group_id',
        'presences_status',
        'presences_date',
        'presences_planning_id',
        'presences_user_created_by',
        'presences_user_updated_by',
    ];

    const CREATED_AT = 'presences_created_at';
    const UPDATED_AT = 'presences_updated_at';

    public function get_agent_count(){ 
        $temp =  DB::select(
            "   select  presences_participant_list
                from presences, plannings, learnings
                WHERE learnings_id = plannings_learning_id
                AND presences_planning_id = plannings_id
                AND learnings_status != -1   
                AND plannings_status = 1 
                AND presences_status = 1   
            ");
            if(count($temp) > 0){
                $count = 0;
                foreach($temp as $value)
                    $count += count(json_decode($value->presences_participant_list));
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
                from presences, plannings, learnings
                WHERE learnings_id = plannings_learning_id
                AND presences_planning_id = plannings_id
                AND learnings_status != -1   
                AND plannings_status = 1 
                AND presences_status = 1   
            ")[0]->learning_count;

    }
   

}
