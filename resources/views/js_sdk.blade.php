<?php
$w = new FooWeChat\Core\WeChatAPI;
$h = new FooWeChat\Helpers\Helper;

$wechat_url = $h->app('ssl')."://res.wx.qq.com/open/js/jweixin-1.1.0.js";

Session::has('deviceid') ? $deviceid = Session::get('deviceid') : $deviceid = 'nv';
?>
@extends('head')
@section('content')
<script src={{ $wechat_url }} type="text/javascript" ></script>

<a href="javascript:close();" btn btn-default>关闭窗口</a><br/><br/>
<a href="javascript:locate();" class="btn btn-default">位置</a><br/><br/>
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
		        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
		        var longitude = res.longitude ; // 经度，浮点数，范围为180 ~ -180。
		        var speed = res.speed; // 速度，以米/每秒计
		        var accuracy = res.accuracy; // 位置精度

		        //alert(latitude+'/'+longitude);
		        var id = <?php echo Session::get('id'); ?>;
		        var deviceid = <?php echo $deviceid ?>;

		        alert(id + '/' + deviceid);
		    }
		});
    }

</script>
@endsection