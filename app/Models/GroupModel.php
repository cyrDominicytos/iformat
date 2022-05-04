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
        'groups_user_created_by',
        'groups_user_updated_by',
    ];

    const CREATED_AT = 'groups_created_at';
    const UPDATED_AT = 'groups_updated_at';

    public function get_group_list($status){
        return  DB::table('groups')
            ->join('users', 'users.id', '=', 'groups_user_created_by')
            ->where('groups_status',$status)
            ->get();
    }
    public function get_group_list_for_update($status, $id){
        return  DB::table('groups')
            ->join('users', 'users.id', '=', 'groups_user_created_by')
            ->where('groups_status',$status)
            ->whereNotIn('groups_id',[$id])
            ->get();
    }
}
