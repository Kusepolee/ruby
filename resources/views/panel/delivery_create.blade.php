<?php
$helper = new FooWeChat\Helpers\Helper;

$unit = $helper->getSelect('unit');

?>
@extends('head')

@section('content')
<div class="container">
	<div class="col-md-4 col-md-offset-4">
  
	<ol class="breadcrumb">
		<li><a href="/panel" class="btn btn-xs btn-info">面板</a></li>
		<li><a href="/panel/delivery" class="btn btn-xs btn-info">发货记录</a></li>
	</ol>
		<div class="panel panel-info">
			<div class="panel-heading">
			<i class="glyphicon glyphicon-tasks"></i>&nbsp新建记录
			</div>
			<div class="panel-body">

			{!! Form::open(['url'=>'panel/delivery/store', 'role' => 'form']) !!}
			{!! Form::hidden('created_by', $id) !!}

			<div class="form-group">
			  {!! Form::text('name',null,['placeholder'=>'产品名称', 'class'=>'form-control']); !!}
			</div>

			<div class="form-group">
			  {!! Form::text('amount',null,['placeholder'=>'数量', 'class'=>'form-control']); !!}
			</div>

			<div class="form-group">
		        {!! Form::select('unit',$unit,null,['class'=>'form-control']) !!}
		    </div>

		    <div class="form-group">
			    <input name = "date" type = "date" class = "form-control">
			</div>

		    <div class="form-group">
			  {!! Form::text('sender',null,['placeholder'=>'发货人', 'class'=>'form-control']); !!}
			</div>

			<div class="form-group">
			  {!! Form::text('receiver',null,['placeholder'=>'收货人', 'class'=>'form-control']); !!}
			</div>

			<div class="form-group">
			  {!! Form::text('company',null,['placeholder'=>'收货人公司名称', 'class'=>'form-control']); !!}
			</div>

			<div class="form-group">
			  {!! Form::text('content',null,['placeholder'=>'备注', 'class'=>'form-control']); !!}
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