<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>酒店简介</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="../home/css/bootstrap.min.css" rel="stylesheet" />
<link href="../home/css/NewGlobal.css" rel="stylesheet" />

<script type="text/javascript" src="../home/js/zepto.js"></script>

</head>
<body>
 <div class="header">
 <a href="/" class="home">
            <span class="header-icon header-icon-home"></span>
            <span class="header-name">主页</span>
</a>
<div class="title" id="titleString"></div>
<a href="javascript:history.go(-1);" class="back">
            <span class="header-icon header-icon-return"></span>
            <span class="header-name">返回</span>
        </a>
 </div>


    
<div class="container">
<ul class="unstyled hotel-bar">
	<li class="first">
    <a href="HotelInfo?id={{Session::get('h_id')}}">房型</a>
	</li>
	<li><a href="home/HotelDesc?id={{Session::get('h_id')}}"  class="active">简介</a></li>
	<li><a href="HotelMap?id={{Session::get('h_id')}}">地图</a></li>
	<li><a href="HotelReview?id={{Session::get('h_id')}}">评论</a></li>
</ul>
<script type="text/javascript">
    $('#titleString').text($(document)[0].title);
</script>
<div class="hotel-prompt ">
    <span class="hotel-prompt-title">酒店图片</span>
<div id="slider" style="margin-top: 10px;">
    @foreach($arr as $k => $v)
 <div>
        <img src="../uploads/hotel/{{$v->img}}">
        <!-- <p>酒店外观</p> -->
 </div>             
    @endforeach
</div>
</div>
<div id="hotelinfo" class="hotel-prompt ">
			<span class="hotel-prompt-title">酒店简介</span>
			<p>{{$res->h_desc}}</p>
            <p>地址：{{$res->h_address}}</p>
            <p>电话：{{$res->h_tel}}</p>
		</div>
</div>
<script>
    //创建slider组件
    $('#slider').slider({ imgZoom: true });
</script>


  <div class="footer">
  <div class="gezifooter">
      
        <?php if(Session::get('user_name')){ ?>
  <font color="#878787">|</font> <a href="loginout" title="退出" >退出</a>
  <?php }else{ ?>
      <a href="Login" class="ui-link">立即登陆</a> <font color="#878787">|</font> 
       <a href="Register" class="ui-link">免费注册</a> <font color="#878787">|</font>   
   <?php } ?>               
                  

       <a href="../www.gridinn.com/@display=pc" class="ui-link">电脑版</a>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
  </div>
  </div>

</body>
</html>
