<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';
    protected $fillable = ['name', 'amount', 'unit', 'content', 'sender', 'receiver', 'company', 'created_by', 'date'];
}