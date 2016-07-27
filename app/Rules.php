<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    protected $table = 'rules'; 
    protected $fillable = ['dp_id', 'item', 'content', 'level', 'order', 'created_by', 'updated_by'];
}