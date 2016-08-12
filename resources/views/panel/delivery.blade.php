<?php
$auth = new FooWeChat\Authorize\Auth;

?>

@extends('head')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="/panel" class="btn btn-xs btn-info">返回面版</a></li>
        <li><a href="/panel/delivery/create" >新建</a></li>
    </ol>

    <div class="table-responsive">
        @if(count($outs))
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>日期</th>
                        <th>名称</th>
                        <th>数量</th>
                        <th>收货单位</th>
                        @if(!$auth->usingWechat())
                        <th>收货人</th>
                        <th>发货人</th>
                        <th>备注</th>
                        <th>创建人</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($outs as $out)
                        <tr>
                            <td>{{ $out->date }}</td>
                            <td> <a href="/panel/delivery/show/{{ $out->id }}" class="btn btn-sm btn-info">{{ $out->name }}</a></td>
                            <td>{{ floatval($out->amount) }}{{ $out->unitName }}</td>
                            <td>{{ $out->company }}</td>
                            @if(!$auth->usingWechat())
                            <td>{{ $out->receiver }}</td>
                            <td>{{ $out->sender }}</td>
                            <td>{{ $out->content }}</td>
                            <td>{{ $out->createByName }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p></p>
            <div class="col-md-4 col-sm-4 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <em class="glyphicon glyphicon-info-sign"></em>&nbsp&nbsp提示
                    </div>
                    <div class="panel-body">
                        <p>无记录: 可能因没有符合查询条件记录, 或尚未有数据录入</p>
                    </div>
                </div>
            </div>
        @endif
            <div> 
            {!! $outs->render() !!}
            </div>
    </div>

</div>
@endsection