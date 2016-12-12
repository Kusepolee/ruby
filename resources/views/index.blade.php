<!DOCTYPE HTML>
<html>
<head>
<title>Henjou.com</title>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/font-awesome.min.css">
<script src="js/jquery.min.js"></script>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
		});
	});
</script>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.useso.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
</script>

</head>
<body>
<div class="header">
  <div class="container">
    <div class="logo"> <a href="/"><img src="images/logo.svg" alt="Nova"></a> </div>
    <div class="menu"> <a class="toggleMenu" href="#"><img src="images/nav_icon.png" alt="" /> </a>
      <ul class="nav" id="nav">
        <li class="current"><a href="/">关于</a></li>
        <li><a href="product_new">产品</a></li>
      </ul>
      <script type="text/javascript" src="js/responsive-nav.js"></script> 
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<div class="banner">
  <div class="container">
  </div>
</div>
<div class="container">
  <div class="content_white">
    <h2>品质塑造未来</h2>
    <p>恒久滚塑制品有限公司是一家专注于滚塑制品的生产企业，坐落于花乡沭阳，紧靠京沪高速，交通十分便捷。滚塑采用旋转一次性成型工艺，有边缘强度好、份量轻、耐冲击、抗腐蚀等优点。历经多年的发展和积累，恒久已经初具规模，拥有高效的人才配备，国内最为先进的设备。公司新开发的滚塑油箱受到全国多家大型拖拉机企业的欢迎并建立了多个长期和合作。没有最好只有更好，我们将继续努力，为您提供更优质的服务，更优秀的产品，欢迎垂询！</p>
  </div>
  </div>

<div class="about">
  <div class="container">
    <section class="title-section">
      <h1 class="title-header">联系我们</h1>
    </section>
  </div>
</div>


<div class="contact">
  <div class="container">
    <div class="row contact_top">
      <div class="col-md-4 contact_details">
        <h5>联系电话:</h5>
        <div class="contact_address"> 0527-83521018</div>
      </div>
      <div class="col-md-4 contact_details">
        <h5>传真:</h5>
        <div class="contact_address"> 0527-87774118<br>
        </div>
      </div>
      <div class="col-md-4 contact_details">
        <h5>Email us:</h5>
        <div class="contact_mail"> jerry@henjou.com</div>
      </div>
    </div>
    <div class="contact_bottom">
      <p>江苏省沭阳县七雄工业园区。</p>
      <form method="post" action="contact-post.html">
        <div class="contact-to">
          <input type="text" class="text" value="姓名" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
          <input type="text" class="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" style="margin-left: 10px">
          <input type="text" class="text" value="主题" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}" style="margin-left: 10px">
        </div>
        <div class="text2">
          <textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">信息..</textarea>
        </div>
        <div> <a href="#" class="submit">发送消息</a> </div>
      </form>
    </div>
  </div>
</div>
<div class="footer">
  <div class="footer_bottom">
    <div class="copy">
      <p>Copyright &copy; 2015 - 2016 江苏恒久滚塑制品有限公司 </p>
    </div>
  </div>
</div>
</body>
</html>