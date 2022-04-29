<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningModel extends Model
{
    use HasFactory;

    protected $table = 'learnings';
    protected $primaryKey = 'learnings_id';

    protected $fillable = [
        'learnings_title',
        'learnings_goal',
        'learnings_target',
        'learnings_duration',
        'learnings_infos',
        'learnings_user_created_by',
        'learnings_user_updated_by',
    ];
}
