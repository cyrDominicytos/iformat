<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanningModel extends Model
{
    use HasFactory;

    protected $table = 'plannings';
    protected $primaryKey = 'plannings_id';

    protected $fillable = [
        'plannings_code',
        'plannings_infos',
        'plannings_teachers',
        'plannings_teachers_roles',
        'plannings_user_groups',
        'plannings_status',
        'plannings_date',
        'plannings_time_slot',
        'plannings_user_created_by',
        'plannings_classroom_id',
        'plannings_learning_id',
        'plannings_user_updated_by',
    ];

    const CREATED_AT = 'plannings_created_at';
    const UPDATED_AT = 'plannings_updated_at';

    public function get_plannings_list($status){
        return  DB::table('plannings')
            ->join('users', 'users.id', '=', 'plannings_user_created_by')
            ->join('classrooms', 'classrooms_id', '=', 'plannings_classroom_id')
            ->join('learnings', 'learnings_id', '=', 'plannings_learning_id')
            ->where('plannings_status',$status)
            ->orderBy('plannings_created_at','DESC')
            ->get();
    }

    //Get learning program for agent
    public function get_participant_planning($group, $beginDate, $endDate, $YearMonth){
       return DB::select(
        "select * from learnings, plannings,users, classrooms
            WHERE learnings_id = plannings_learning_id  
            AND users.id = plannings_user_created_by
            AND classrooms_id = plannings_classroom_id
            AND learnings_status = 1
            AND JSON_SEARCH(plannings_user_groups, 'all', '".$group."', NULL ) IS NOT NULL
            AND  plannings_created_at BETWEEN '".$beginDate."' AND '".$endDate."' 
            AND JSON_SEARCH(plannings_date , 'all', '".$YearMonth."%', NULL ) IS NOT NULL
            ");
        }

    /**
     * Get the classroom associated with the plannings.
     */
    public function classroom()
    {
        return $this->hasOne(ClassRoomModel::class, "classrooms_id", "plannings_classroom_id");
    }

}
