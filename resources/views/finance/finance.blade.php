<?php
	$a = new FooWeChat\Authorize\Auth;
	$h = new FooWeChat\Helpers\Helper;
    $id = Session::get('id');

    $seekDp != 0 ? $seekDp_string = $seekDp : $seekDp_string = '_not';
    $seekName != 0 ? $seekName_string = $seekName : $seekName_string = '_not';
    $full_seek_string = $seekDp_string."-".$seekName_string;
?>
@extends('head')

@section('content')

<div class="container">
	<div class="col-md-16">
    <ol class="breadcrumb">
        <li class="active" >财务</li>
        <li><a href="/finance/outs">支出</a></li>
        @if($seekDp != 0 || $seekName != 0)
        <li><a href="/finance">重置查询条件</a></li>
        @endif
    </ol>
        <ul id="myTab" class="nav nav-tabs">
        @if($seekDp != 0 || $seekName != 0)
            @if(Input::has('p') && !Input::has('page'))
            <li class=""><a href="#outs" data-toggle="tab">支出</a>
            <li class="active"><a href="#trans" data-toggle="tab">流向</a>
            @else
            <li class="active"><a href="#outs" data-toggle="tab">支出</a>
            <li class=""><a href="#trans" data-toggle="tab">流向</a>
            @endif
        @else
            @if(Input::has('p') && !Input::has('page'))
            <li class=""><a href="#outs" data-toggle="tab">支出</a>
            <li class="active"><a href="#trans" data-toggle="tab">流向</a>
            @else
            <li class="active"><a href="#outs" data-toggle="tab">支出</a>
            <li class=""><a href="#trans" data-toggle="tab">流向</a>
            @endif
        @endif
            <!-- 余额 -->
        @if ($a->auth(['position'=>'>=总监']))
            <li class=""><a href="#seek" data-toggle="tab">查询</a></li>
        @endif
            <li><a href="#manage" data-toggle="tab">功能</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <!-- outs list -->
            @if(Input::has('p') && !Input::has('page'))
            <div class="tab-pane fade" id="outs">
            @else
            <div class="tab-pane fade active in" id="outs">
            @endif
                <div class="table-responsive">
                    @if(count($outs))
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>日期</th>
                                    <th>金额</th>
                                    <th>经手人</th>
                                    @if(!$a->usingWechat())                        
                                    <th>支出项</th>
                                    <th>单据</th>
                                    <th>相关业务</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($outs as $out)
                                <tr>
                                	<td>{{ $out->out_date }}</td>
                                    @if($out->out_bill != '29')
                                	<td><a href="/finance/outs/show/{{ $out->id }}" class="btn btn-sm btn-info">{{ floatval($out->out_amount) }}</td>
                                    @else
                                    <td><a href="/finance/outs/show/{{ $out->id }}" class="btn btn-sm btn-success">{{ floatval($out->out_amount) }}</td>
                                    @endif
                                	<td>{{ $out->userName }}</td>
                                	@if(!$a->usingWechat())                        
                                    <td>{{ $out->out_item }}</td>
                                    <td>{{ $out->outBill }}</td>
                                    <td>{{ $out->dpName }}</td>
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
            <!-- end of outs list -->
            <!-- trans list -->
            @if(Input::has('p')&& !Input::has('page'))
            <div class="tab-pane fade active in" id="trans">
            @else
            <div class="tab-pane fade" id="trans">
            @endif
                <div class="table-responsive">
                    @if(count($trans))
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>日期</th>
                                    <th>金额</th>
                                    <th>流向</th>
                                    @if(!$a->usingWechat())                        
                                    <th>方式</th>
                                    <th>用途</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($trans as $tran)
                            	<tr>
                                    <td>{{ $tran->tran_date }}</td>
                                    @if($tran->tran_state != 1)
                                	<td><a href="/finance/trans/show/{{ $tran->id }}" class="btn btn-sm btn-danger">{{ floatval($tran->tran_amount) }}</td>
                                    @else
                                    <td><a href="/finance/trans/show/{{ $tran->id }}" class="btn btn-sm btn-info">{{ floatval($tran->tran_amount) }}</td>
                                    @endif
                                	<td>{{ $tran->fromName }}>{{ $tran->toName }}</td>
                                	@if(!$a->usingWechat())                        
                                    <td>{{ $tran->tranType }}</td>
                                    <td>{{ $tran->tran_item }}</td>
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
                            {!! $trans->render() !!}
                        </div>
                </div>
            </div>
            <!-- end of trans list -->
            <!-- seek -->
            <div class="tab-pane fade" id="seek">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel-heading">
                        {!! Form::open(['url'=>'finance/seek', 'role' => 'form', 'id' => 'self_seek']) !!}
                        {!! Form::hidden('seekName', $id) !!}
                        {!! Form::hidden('seekDp', '') !!}
                        {!! Form::close() !!}
                        <em class="glyphicon glyphicon-th-list"></em>&nbsp&nbsp筛选条件:<a href="javascript:selfSeek();"> 只显示自己</a><a style=" float:right;" href="" class="glyphicon glyphicon-question-sign"></a>
                    </div>
                    <div class="panel-heading">

                        {!! Form::open(['url'=>'finance/seek', 'role' => 'form']) !!}

                        <p></p>
                        <label id="type_label">部门</label>
                        <div class="form-group">
                        {!! Form::select('seekDp',$Dp, null,['class'=>'form-control']); !!}
                        </div>

                        <p></p>
                        <label id="type_label">姓名</label>
                        <div class="form-group">   
                        {!! Form::select('seekName',$Mb,null,['class'=>'form-control']) !!}
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
                                  {!! Form::open(['url'=>'/excel/finance', 'role' => 'form', 'id'=>'excel_get']) !!}
                                  {!! Form::hidden('seek_string', $full_seek_string) !!}
                                  {!! Form::close() !!}
                                  <!-- end of form excel -->

                          <input type="hidden" id="seek_string" value="{{$full_seek_string}}">
                          <input type="hidden" id="_token" value="{{$full_seek_string}}">
                        </div>
                        <div class="panel-footer">
                          @if($a->auth(['admin'=>'no', 'user'=>'2', 'position'=>'>=经理', 'department'=>'>=运营部|资源部']))
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
// self_seek
function selfSeek(){
  $("#self_seek").submit();
}
</script>

@endsection