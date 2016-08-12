<?php  
$auth = new FooWeChat\Authorize\Auth;
$helper = new FooWeChat\Helpers\Helper;

$unit = $helper->getSelect('unit');
$type = $helper->getSelect('resourceType');
$dp = $helper->getAllDepartments();

?>
@extends('head')

@section('content')

<div class="container">
	<div class="col-md-4 col-md-offset-4">
	    <ol class="breadcrumb">
	        <li><a href="/product" class="btn btn-xs btn-info">返回产品</a></li>
	        <li class="active">{{ $act or '' }}</li>
	    </ol>
	    <div class="panel panel-info">
		    <div class="panel-heading">
		        <i class="glyphicon glyphicon-list-alt"></i>&nbsp{{ isset($rec) ? $rec->name.$rec->model : $act }}
		        <!-- <a style=" float:right;" href="#" class="glyphicon glyphicon-question-sign"></a> -->
		    </div>
		    <div class="panel-body">
		        @if(isset($rec))
		        {!! Form::open(['url'=>'product/update/'.$rec->id, 'role' => 'form']) !!}
		        @else
		        {!! Form::open(['url'=>'product/store', 'role' => 'form']) !!}
		        @endif

		        <div class="form-group">
		          {!! Form::text('name', isset($rec) ? $rec->name : null,['placeholder'=>'产品名称', 'class'=>'form-control']) !!}
		        </div>
		      
		        <div class="form-group">
		          {!! Form::text('model', isset($rec) ? $rec->model : null,['placeholder'=>'型号(没有则不填)', 'class'=>'form-control']) !!}
		        </div>
		      
		        <div class="form-group">
		          {!! Form::select('unit', $unit, isset($rec) ? $rec->unit : null,['class'=>'form-control']); !!}
		        </div>

		        <div class="form-group">
		          {!! Form::select('type',$type, isset($rec) ? $rec->type : null,['class'=>'form-control']); !!}
		        </div>

		        <div class="form-group">
		          {!! Form::select('department',$dp, isset($rec) ? $rec->department : null,['class'=>'form-control']); !!}
		        </div>

		        <div class="form-group">
		          {!! Form::text('notice', isset($rec) ? floatval($rec->notice) : null,['placeholder'=>'提醒值', 'class'=>'form-control']) !!}
		        </div>

		        <div class="form-group">
		          {!! Form::text('alert', isset($rec) ? floatval($rec->alert) : null,['placeholder'=>'报警值', 'class'=>'form-control']) !!}
		        </div>

		        <div class="form-group">
		          {!! Form::text('content', isset($rec) ? $rec->content : null,['placeholder'=>'备注(可不填)', 'class'=>'form-control']) !!}
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