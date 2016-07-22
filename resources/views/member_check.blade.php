<?php
$w = new FooWeChat\Core\WeChatAPI;
$h = new FooWeChat\Helpers\Helper;

$wechat_url = $h->app('ssl')."://res.wx.qq.com/open/js/jweixin-1.1.0.js";

Session::has('id') ? $id = Session::get('id') : $id = 'NV';
Session::has('deviceid') ? $deviceid = Session::get('deviceid') : $deviceid = 'NV';
?>
@extends('head')
@section('content')
<script src={{ $wechat_url }} type="text/javascript" ></script>

{!! Form::open(['url'=>'member/check/store', 'role' => 'form', 'id' =>'locate']) !!}
{!! Form::hidden('user_id', $id) !!}
{!! Form::hidden('deviceid', $deviceid) !!}
{!! Form::hidden('latitude', null, ['id'=>'latitude']) !!}
{!! Form::hidden('longitude', null, ['id'=>'longitude']) !!}
{!! Form::hidden('speed', null, ['id'=>'speed']) !!}
{!! Form::hidden('accuracy', null, ['id'=>'accuracy']) !!}
{!! Form::close() !!}

<div class="container">
    <div class="col-md-4 col-sm-4" id="excel_div">
    	<div class="panel panel-success">
        <div class="panel-heading">
            <i class="glyphicon glyphicon-th"></i>&nbsp&nbsp考勤和加班
        </div>
        <div class="panel-body">
          <span id="info_txt"></span>
          <blockquote>
            <small>本系统将使用您的位置信息. 若不使用微信系统打卡, 可以使用公司指纹考勤机, 但尽量避免交叉使用. 若有交叉使用情况将由人工核实登记, 经常性需人工核实的视同工作失职, 浪费人工费将从工资中扣除</small>
          </blockquote>
        </div>
        <div class="panel-footer">
            <a class="btn btn-sm btn-success btn-block" href="javascript:locate();">提交位置信息</a>
        </div>
    	</div>
	</div>
</div>



<script type="text/javascript" >
    wx.config(<?php echo $w->getSignature(false,['closeWindow', 'getLocation']); ?>);
    
    function close()
    {
    	wx.closeWindow();
    }

    function locate()
    {
    	wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
		    success: function (res) {
		        $("#latitude").val(res.latitude); // 纬度，浮点数，范围为90 ~ -90
		        $("#longitude").val(res.longitude ); // 经度，浮点数，范围为180 ~ -180。
		        $("#speed").val(res.speed); // 速度，以米/每秒计
		        $("#accuracy").val(res.accuracy); // 位置精度

		        $("#locate").submit();
		    }
		});
    }

</script>
@endsection