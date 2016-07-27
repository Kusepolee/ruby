@extends('head')

@section('content')

<div class="container">
    <ol class="breadcrumb">
        <li><a href="/panel" class="btn btn-xs btn-info">返回工作面版</a></li>
        <li><a href="/panel/rules/create" class="btn btn-xs btn-info">新建</a></li>
    </ol>
	<div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>总章</h4>
                </div>
                <div class="panel-body">
                    @foreach($recs as $rec)
                    @if($rec->level === 0)
                    <blockquote style="border-color:#d9edf7;">
                    @elseif($rec->level === 1)
                    <blockquote style="border-color:#fcf8e3;">
                    @else
                    <blockquote style="border-color:#f2dede;">
                    @endif
                        <h5>{{$rec->content}}</h5>
                        <small><a class="btn btn-xs btn-default pull-right" href="/panel/rules/edit/{{$rec->id}}">修改</a></small>
                    </blockquote>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection