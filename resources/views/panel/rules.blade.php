<?php  
$a = new FooWeChat\Authorize\Auth;

?>
@extends('head')

@section('content')

<div class="container">
    <ol class="breadcrumb">
        <li><a href="/panel" class="btn btn-xs btn-info">返回工作面版</a></li>
        <li><a href="/panel/rules/create" >新建</a></li>
    </ol>
	<div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    总章
                </div>
                <div class="panel-body">
                    @foreach($firsts as $first)
                        @if($first->item != '' && $first->item != null)
                        <p>{{ $first->item }}</p>
                        @endif
                    @if($first->level === 0)
                    <blockquote style="border-color:#d9edf7;">
                    @elseif($first->level === 1)
                    <blockquote style="border-color:#fcf8e3;">
                    @else
                    <blockquote style="border-color:#f2dede;">
                    @endif
                        <small>{{$first->content}}</small>
                        @if($a->auth(['position' => '>=总监', 'department' => '>=运营部']))
                        <small><a class="btn btn-xs btn-success pull-right" href="/panel/rules/edit/{{$first->id}}">修改</a></small>
                        @endif
                    </blockquote>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if($dp > 4 && $dp != 6 && $dp != 10)
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ $dp_name }}
                </div>
                <div class="panel-body">
                @if(isset($groups[$dp]))
                    @foreach($groups[$dp] as $group)
                        @if($group->item != '' && $group->item != null)
                        <p>{{ $group->item }}</p>
                        @endif
                    @if($group->level === 0)
                    <blockquote style="border-color:#d9edf7;">
                    @elseif($group->level === 1)
                    <blockquote style="border-color:#fcf8e3;">
                    @else
                    <blockquote style="border-color:#f2dede;">
                    @endif
                        <small>{{$group->content}}</small>
                        @if($a->auth(['position' => '>=总监', 'department' => '>=运营部']))
                        <small><a class="btn btn-xs btn-success pull-right" href="/panel/rules/edit/{{$group->id}}">修改</a></small>
                        @endif
                    </blockquote>
                    @endforeach
                @else
                    <blockquote style="border-color:#f2dede;">
                        <small>尚无规章</small>
                        @if($a->auth(['position' => '>=总监', 'department' => '>=运营部']))
                        <small><a class="btn btn-xs btn-success pull-right" href="/panel/rules/create">新建</a></small>
                        @endif
                    </blockquote>
                @endif
                </div>
            </div>
        </div>
    </div>
    @else
        @foreach($dps as $key => $value)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {{ $value }}
                    </div>
                    <div class="panel-body">
                        @foreach($groups[$key] as $group)
                            @if($group->item != '' && $group->item != null)
                            <p>{{ $group->item }}</p>
                            @endif
                        @if($group->level === 0)
                        <blockquote style="border-color:#d9edf7;">
                        @elseif($group->level === 1)
                        <blockquote style="border-color:#fcf8e3;">
                        @else
                        <blockquote style="border-color:#f2dede;">
                        @endif
                            <small>{{$group->content}}</small>
                            @if($a->auth(['position' => '>=总监', 'department' => '>=运营部']))
                            <small><a class="btn btn-xs btn-success pull-right" href="/panel/rules/edit/{{$group->id}}">修改</a></small>
                            @endif
                        </blockquote>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>

@endsection