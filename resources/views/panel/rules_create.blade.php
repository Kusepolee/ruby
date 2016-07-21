<?php
	$id = Session::get('id');
	$level = ['普通', '重要' ,'非常重要'];
?>
@extends('head')

@section('content')
<div class="container">
	<div class="col-md-4 col-md-offset-4">
  
	<ol class="breadcrumb">
		<li><a href="/panel">面板</a></li>
		<li><a href="/panel/rules">规章制度</a></li>
	</ol>
		<div class="panel panel-info">
			<div class="panel-heading">
			<i class="glyphicon glyphicon-tasks"></i>&nbsp新增规章
			<!-- <a style=" float:right;" href="#" class="glyphicon glyphicon-question-sign"></a> -->
			</div>
			<div class="panel-body">

			{!! Form::open(['url'=>'panel/rules/store', 'role' => 'form']) !!}
			{!! Form::hidden('user_id', $id) !!}

			<div class="form-group">
			  {!! Form::select('dp_id',$dp,null,['class'=>'form-control']); !!}
			</div>

			<div class="form-group">
		        {!! Form::text('order','',['placeholder'=>'排序(填写数字)', 'class'=>'form-control']) !!}
		    </div>

			<div class="form-group">
			  {!! Form::select('level',$level,null,['class'=>'form-control']); !!}
			</div>

			<div class="form-group">
			  {!! Form::textarea('content',null,['placeholder'=>'内容', 'class'=>'form-control', 'rows'=>'10']) !!}
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