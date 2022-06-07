<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LearningModel extends Model
{
    use HasFactory;

    protected $table = 'learnings';
    protected $primaryKey = 'learnings_id';

    protected $fillable = [
        'learnings_title',
        'learnings_code',
        'learnings_title2',
        'learnings_goal',
        'learnings_target',
        'learnings_duration',
        'learnings_infos',
        'learnings_days',
        'learnings_time_slot',
        'learnings_user_created_by',
        'learnings_user_updated_by',
    ];

    const CREATED_AT = 'learnings_created_at';
    const UPDATED_AT = 'learnings_updated_at';

    public function get_learnings_list($statusArray){
        return  DB::table('learnings')
            ->join('users', 'users.id', '=', 'learnings_user_created_by')
            ->whereNotIn('learnings_status',$statusArray)
            ->orderBy('learnings_created_at','DESC')
            ->get();
    }
    public function get_participant_learnings_list($group, $id){
        return DB::select("select * from learnings, plannings WHERE learnings_id = plannings_learning_id  AND learnings_status=1  AND JSON_SEARCH(plannings_user_groups, 'all', '".$group."', NULL ) IS NOT NULL AND learnings_id NOT IN (SELECT assessments_learning_id FROM assessments WHERE assessments_learning_id= learnings_id AND assessments_participant_id=".$id.")");
        /*return  DB::table('learnings')
            ->join('plannings', 'plannings_learning_id', '=', 'learnings_id')
            ->join('users', 'users.id', '=', 'learnings_user_created_by')
            ->whereIn(,'learnings_status')
            ->whereNotIn('learnings_status',1)
            ->orderBy('learnings_created_at','DESC')
            ->get();*/
    }

    

    public function generateUniqueCode()
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;
        $code = '';
        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if ($this::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }
        return $code;
    }
}
