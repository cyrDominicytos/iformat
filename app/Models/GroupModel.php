<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GroupModel extends Model
{
    use HasFactory;

    protected $table = 'groups';
    protected $primaryKey = 'groups_id';

    protected $fillable = [
        'groups_name',
        'groups_participant',
        'groups_detail',
        'groups_status',
        'groups_learning_id',
        'groups_user_created_by',
        'groups_user_updated_by',
    ];

    const CREATED_AT = 'groups_created_at';
    const UPDATED_AT = 'groups_updated_at';

    public function get_group_list($status){
        return  DB::table('groups')
            ->join('users', 'users.id', '=', 'groups_user_created_by')
            ->join('learnings', 'learnings_id', '=', 'groups_learning_id')
            ->where('groups_status',$status)
            ->whereNotIn('learnings_status',[-1])
            ->orderBy('groups_created_at','DESC')
            ->get();
    }
    public function get_group_list_for_update($status, $id){
        return  DB::table('groups')
            ->join('users', 'users.id', '=', 'groups_user_created_by')
            ->where('groups_status',$status)
            ->whereNotIn('groups_id',[$id])
            ->get();
    }

    public function get_user_group($id){
        return DB::select("select * from groups  WHERE JSON_SEARCH(groups_participant, 'all', '".$id."', NULL ) IS NOT NULL");
    }
}
