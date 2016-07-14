<?php
$t = new FooWeChat\Authorize\Auth;
$h = new FooWeChat\Helpers\Helper;

$rescType_list  = $h->getRescTypesInUse();

//设置EXCEL查询条件
count($rescType) ? $rescType_string = implode("|", $rescType) : $rescType_string = '_not';
$key != '' && $key != null ? $key_string = $key : $key_string = '_not';
$full_seek_string = $rescType_string."-".$key_string;
?>
@extends('head')

@section('content')

<script src="{{ URL::asset('bower_components/iCheck/icheck.min.js') }}"></script>
<link href="{{ URL::asset('bower_components/iCheck/skins/square/blue.css') }}" rel="stylesheet">

<div class="container">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="active" >资源管理</li>
            <li><a href="/resource/create">添加资源</a></li>
            @if(count($rescType) || ($key != '' && $key != null))
            <li><a href="/resource">重置查询条件</a></li>
            @endif
        </ol>
            <ul id="myTab" class="nav nav-tabs">
            @if(count($rescType) || ($key != '' && $key != null))
                <li class="active"><a href="#resources" data-toggle="tab">查询结果</a>
            @else
                <li class="active"><a href="#resources" data-toggle="tab">资源</a>
            @endif
                </li>
                <li class=""><a href="#seek" data-toggle="tab">查询</a></li>
                <li><a href="#manage" data-toggle="tab">功能</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <!-- resources list -->
                <div class="tab-pane fade active in" id="resources">
                    <div class="table-responsive">
                        @if(count($outs))
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>名称</th>
                                        <th>型号</th>
                                        <th>库存</th>
                                        <th>单位</th>
                                        @if(!$t->usingWechat())                        
                                        <th>类型</th>
                                        <th>提醒值</th>
                                        <th>报警值</th>
                                        <th>创建人</th>
                                        <th>备注</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($outs as $out)
                                        <tr>
                                            <td>{{ $out->id }}</td>
                        
                                            @if($h->rescState($out->id) == 0)
                                                <td> <a href="/resource/show/{{ $out->id }}" class="btn btn-sm btn-default">{{ $out->name }}</a>
                                                @elseif($h->rescState($out->id) == 1)
                                                <td> <a href="/resource/show/{{ $out->id }}" class="btn btn-sm btn-danger">{{ $out->name }}</a>
                                                @elseif($h->rescState($out->id) == 2)
                                                <td> <a href="/resource/show/{{ $out->id }}" class="btn btn-sm btn-warning">{{ $out->name }}</a>
                                                @elseif($h->rescState($out->id) == 3)
                                                <td> <a href="/resource/show/{{ $out->id }}" class="btn btn-sm btn-success">{{ $out->name }}</a>
                                                @else
                                                <td> <a href="/resource/show/{{ $out->id }}" class="btn btn-sm btn-info">{{ $out->name }}</a>
                                            @endif
                                            </td>
                                            <td>{{ $out->model }}</td>
                                            <td>{{ floatval($out->remain) }}</td>
                                            <td>{{ $out->unitName }}</td>
                                            @if(!$t->usingWechat())
                                            <td>{{ $out->typeName }}</td>
                                            <td>{{ floatval($out->notice) }}</td>
                                            <td>{{ floatval($out->alert) }}</td>
                                            <td>{{ $out->createByName }}</td>
                                            <td>{{ $out->content }}</td>
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
                <!-- seek -->
                <div class="tab-pane fade" id="seek">

                        <div class="col-md-4 col-md-offset-4">
                            <div class="panel-heading"><em class="glyphicon glyphicon-th-list"></em>&nbsp&nbsp筛选条件:<a style=" float:right;" href="" class="glyphicon glyphicon-question-sign"></a></div>
                                <div class="panel-heading">

                                    {!! Form::open(['url'=>'resource/seek', 'role' => 'form']) !!}
                                
                                    <label id="type_label">资源类型</label>
                                    <div class="form-group">

                                    {!! Form::select('rescType_val',$rescType_list, null,['class'=>'form-control']); !!}

                                    </div>
                            
                                    <p></p>
                                    <div class="form-group">
                                        <label>关键词</label>    
                                    {!! Form::text('key',null,['placeholder'=>'关键词', 'class'=>'form-control']) !!}
                                    </div>        

                                    {!! Form::submit("查询", ['class'=>'btn btn-info btn-block']) !!}

                                    {!! Form::close() !!}
                                </div>

                        </div>
                </div>
                <!-- end of seek -->
                <p></p>
                <div class="tab-pane fade" id="manage">
                    <div class="col-md-4 col-sm-4" id="excel_div">
                        <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-th"></i>&nbsp&nbspExcel
                        </div>
                        <div class="panel-body">
                          <span id="info_txt"></span>
                            <blockquote>
                            <small>将本次查询结果保存为Excel文件, 若有多页, 则所有结果都保存,但Excel文件中不再分页。</small>
                          </blockquote>
                                  <!-- form excel -->
                                  {!! Form::open(['url'=>'/excel/resource', 'role' => 'form', 'id'=>'excel_get']) !!}
                                  {!! Form::hidden('seek_string', $full_seek_string) !!}
                                  {!! Form::close() !!}
                                  <!-- end of form excel -->

                          <input type="hidden" id="seek_string" value="{{$full_seek_string}}">
                          <input type="hidden" id="_token" value="{{$full_seek_string}}">
                        </div>
                        <div class="panel-footer">
                          @if($t->auth(['admin'=>'no', 'position'=>'>=经理', 'department' => '>=资源部|生产部']))
                            <a class="btn btn-sm btn-success btn-block" href="javascript:getExcel();">保存</a>
                          @else 
                          没有权限
                          @endif 
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<script>
    // excel
function getExcel(){
  $("#excel_get").submit();
}
</script>
@endsection