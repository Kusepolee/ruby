<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
     protected $table = 'work_time';
     protected $fillable = ['target_id', 'type', 'week', 'month', 'content'];
}
