<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers'; 
    protected $fillable = ['vip_id', 'nic_name', 'name', 'img', 'type', 'state', 'content'];
    //public $timestamps = false;
}
