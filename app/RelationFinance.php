<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationFinance extends Model
{
    protected $table = 'relation_finance';
    protected $fillable = ['table','owner_id','default','name','account','bank','content','create_by'];
}

