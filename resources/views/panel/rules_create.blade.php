<?php
	use App\Member;
	use App\Department; 

	$a = new FooWeChat\Authorize\Auth;

	$id = Session::get('id');
	$dpId = Member::find($id)->department;
	$dpName = Department::find($dpId)->name;

	if($a->auth(['position'=>'>=总监', 'department'=>'>=运营部'])){
		$departments = Department::where('id', '>', 1)
					->get();
		if(count($departments)){
			$dp = [];
			foreach ($departments as $department) {
				$dp = array_add($dp, $department->id, $department->name);
			}
		}
	}
	else $dp = [$dpId=>$dpName];

	$level = ['普通', '注意' ,'特别注意'];
	
?>
@extends('head')

@section('content')
<div class="container">
	<div class="col-md-4 col-md-offset-4">
  
	<ol class="breadcrumb">
		<li><a href="/panel" class="btn btn-xs btn-info">面板</a></li>
		<li><a href="/panel/rules" class="btn btn-xs btn-info">规章制度</a></li>
	</ol>
		<div class="panel panel-info">
			<div class="panel-heading">
			<i class="glyphicon glyphicon-tasks"></i>&nbsp新增规章
			<!-- <a style=" float:right;" href="#" class="glyphicon glyphicon-question-sign"></a> -->
			</div>
			<div class="panel-body">
			@if(!isset($rec))
			{!! Form::open(['url'=>'panel/rules/store', 'role' => 'form']) !!}
			{!! Form::hidden('created_by', $id) !!}
			@else
			{!! Form::open(['url'=>'panel/rules/update/'.$rec->id, 'role' => 'form']) !!}
			{!! Form::hidden('updated_by', $id) !!}
			@endif

			<div class="form-group">
			  {!! Form::select('dp_id',$dp, isset($rec) ? $rec->dp_id : null,['class'=>'form-control']); !!}
			</div>

			<div class="form-group">
			  {!! Form::select('level',$level, isset($rec) ? $rec->level : null,['class'=>'form-control']); !!}
			</div>

			<div class="form-group">
		        {!! Form::text('order', isset($rec) ? $rec->order : null,['placeholder'=>'排序(填写数字)', 'class'=>'form-control']) !!}
		    </div>
		    
			<div class="form-group">
		        {!! Form::text('item', isset($rec) ? $rec->item : null,['placeholder'=>'标题', 'class'=>'form-control']) !!}
		    </div>

			<div class="form-group">
			  {!! Form::textarea('content', isset($rec) ? $rec->content : null,['placeholder'=>'内容', 'class'=>'form-control', 'rows'=>'10']) !!}
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