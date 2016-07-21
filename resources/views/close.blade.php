<?php 
$w = new FooWeChat\Core\WeChatAPI;
$h = new FooWeChat\Helpers\Helper;

$wechat_url = $h->app('ssl')."://res.wx.qq.com/open/js/jweixin-1.1.0.js";
?>
<!DOCTYPE html>
<html>
<head>
	<title>close</title>
</head>
<body>
<script src={{ $wechat_url }} type="text/javascript" ></script>
<script type="text/javascript" >
    wx.config(<?php echo $w->getSignature(false,['closeWindow']); ?>);

    wx.ready(function(){
    	 wx.closeWindow();
	});
</script>
</body>
</html>
