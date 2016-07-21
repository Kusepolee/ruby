<?php 
$w = new FooWeChat\Core\WeChatAPI;
$h = new FooWeChat\Helpers\Helper;

$wechat_url = $h->app('ssl')."://res.wx.qq.com/open/js/jweixin-1.1.0.js";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" >
   <link href="{{ URL::asset('custom/css/style.css') }}" rel="stylesheet" type="text/css" >
   <script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
   <script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

</head>
<body>
  <div class="container">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-6  col-md-offset-3">
            <div class="alert alert-info text-center">
          <h4>正在返回</h4> 
          <hr />
          <i class="fa fa-warning fa-4x"></i>
          <p>
              关闭应用并返回微信...
          </p>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src={{ $wechat_url }} type="text/javascript" ></script>
<script type="text/javascript" >
    wx.config(<?php echo $w->getSignature(false,['closeWindow']); ?>);

    wx.ready(function(){
    	 wx.closeWindow();
	});
</script>
</body>
</html>
