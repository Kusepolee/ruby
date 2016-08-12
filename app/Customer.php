<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers'; 
    protected $fillable = ['vip_id', 'nic_name', 'name', 'img', 'type', 'state', 'content'];
    //public $timestamps = false;
}
