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

}
