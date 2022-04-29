<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassRoomModel extends Model
{
    use HasFactory;

    protected $table = 'classrooms';
    protected $primaryKey = 'classrooms_id';

    protected $fillable = [
        'classrooms_name',
        'classrooms_countries_id',
        'classrooms_detail',
        'classrooms_user_created_by',
        'classrooms_user_updated_by',
    ];

    const CREATED_AT = 'classrooms_created_at';
    const UPDATED_AT = 'classrooms_updated_at';

    public function get_rooms_list(){
        return  DB::table('classrooms')
            ->join('users', 'users.id', '=', 'classrooms_user_created_by')
            ->get();
    }
}
