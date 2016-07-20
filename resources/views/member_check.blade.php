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

<a href="javascript:close();" btn btn-default>关闭窗口</a><br/><br/>
<a href="javascript:locate();" class="btn btn-default">位置</a><br/><br/>

{!! Form::open(['url'=>'member/check/store', 'role' => 'form', 'id' =>'locate']) !!}
{!! Form::hidden('id', $id) !!}
{!! Form::hidden('deviceid', $deviceid) !!}
{!! Form::hidden('latitude', null, ['id'=>'latitude']) !!}
{!! Form::hidden('longitude', null, ['id'=>'longitude']) !!}
{!! Form::hidden('speed', null, ['id'=>'speed']) !!}
{!! Form::hidden('accuracy', null, ['id'=>'accuracy']) !!}
{!! Form::close() !!}



<script type="text/javascript" >
    wx.config(<?php echo $w->getSignature(false,['closeWindow', 'scanQRCode', 'getLocation']); ?>);
    
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