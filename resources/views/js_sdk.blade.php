<?php
$w = new FooWeChat\Core\WeChatAPI;
?>
@extends('head')
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $w->getSignature(true,['closeWindow', 'scanQRCode']); ?>);

    function close()
    {
    	wx.closeWindow();
    }

    function alert()
    {
    	alert('fuck');
    }
</script>
@section('content')

<a href="javascript:close();">关闭窗口</a><br/><br/>
<a href="javascript:alert();">测试</a>
@endsection