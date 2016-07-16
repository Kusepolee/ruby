<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinanceOuts extends Model
{
	protected $table = 'finance_outs';
	protected $fillable = ['id', 'out_user', 'out_amount', 'out_item', 'out_date', 'out_bill', 'out_about'];
}