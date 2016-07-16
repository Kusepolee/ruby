<?php
$h = new FooWeChat\Helpers\Helper;

$type = $h->getSelect('financeTran');

$f_or_t = ['给予','收到']
?>
@extends('head')

@section('content')
<div class="container">
	<div class="col-md-4 col-md-offset-4">
  
	<ol class="breadcrumb">
		<li><a href="/finance">财务</a></li>
		<li class="active" >资金往来</li>
	</ol>
		<div class="panel panel-info">
			<div class="panel-heading">
			<i class="glyphicon glyphicon-jpy"></i>&nbsp资金往来
			</div>
			<div class="panel-body">

			{!! Form::open(['url'=>'finance/trans/store', 'role' => 'form']) !!}
			{!! Form::hidden('S_id', $S_id) !!}
			{!! Form::hidden('S_name', $S_name) !!}
			{!! Form::hidden('M_id', $M_id) !!}
			{!! Form::hidden('M_name', $M_name) !!}
			{!! Form::hidden('M_work_id', $M_work_id) !!}

			<div class="form-group">
			  {!! Form::select('f_or_t',$f_or_t,null,['class'=>'form-control']); !!}
			</div>

			<div class="form-group">
			  {!! Form::text('tran_amount',null,['placeholder'=>'金额', 'class'=>'form-control']) !!}
			</div>
			
			<div class="form-group">
			  {!! Form::text('tran_item',null,['placeholder'=>'用途', 'class'=>'form-control']); !!}
			</div>
			
			<div class="form-group">
			    <input name = "tran_date" type = "date" class = "form-control">
			</div>

			<div class="form-group">
			  {!! Form::select('tran_type',$type,null,['class'=>'form-control']); !!}
			</div>

			{!! Form::submit('提交', ['class'=>'btn btn-info btn-block']) !!}

			{!! Form::close() !!}

			</div>
	    </div>

	    	@if($errors->any())  
            <div class="panel-body">
            <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>错误: {{ $error }}</p>
            @endforeach
            </div>
            </div>
                      
        @endif
	</div>
</div>
@endsection