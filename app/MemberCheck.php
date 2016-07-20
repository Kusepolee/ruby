<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberCheck extends Model
{
     protected $table = 'member_check';
     protected $fillable = ['user_id', 'deviceid', 'latitude', 'longitude', 'speed', 'accuracy', 'type', 'content'];
}
