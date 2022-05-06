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

    public function get_learnings_list($status){
        return  DB::table('learnings')
            ->join('users', 'users.id', '=', 'learnings_user_created_by')
            ->where('learnings_status',$status)
            ->get();
    }
}
