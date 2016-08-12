<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $fillable = ['table','owner_id','default','state','addr','post_code','tel','fax','email','email_confirmed','web','mobile','mobile_confirmed','wechat','qq','content','create_by'];
}
