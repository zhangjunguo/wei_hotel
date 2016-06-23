<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的格子</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="../home/css/bootstrap.min.css" rel="stylesheet" />
<link href="../home/css/NewGlobal.css" rel="stylesheet" />

<script type="text/javascript" src="../home/js/zepto.js"></script>
<script src="../js/jq.js"></script>

</head>
<body id="div1">

 <div class="header">
 <a href="/" class="home">
            <span class="header-icon header-icon-home"></span>
            <span class="header-name">主页</span>
</a>
<div class="title" id="titleString">我的订单</div>
<a href="javascript:history.go(-1);" class="back">
            <span class="header-icon header-icon-return"></span>
            <span class="header-name">返回</span>
        </a>
 </div>
<div class="order-nav">
<ul class="unstyled hotel-bar">
      <li><a href="MyOrder"  >全部</a></li>
      <li><a href="my_order_no">未完成</a></li>
      <li  class="first"><a class="active" href="my_order_yes">已完成</a></li>
      <li><a href="my_order_pay">待支付</a></li>
</ul>
</div>
     
  <div class="container hotellistbg" >
         <ul class="unstyled hotellist">
        
             @foreach($data['data'] as $k => $v)
             <li>
              <a href="order_info?id={{$v->o_id}}">
                 <img class="hotelimg fl" src="../uploads/{{$v->h_img}}" /> 
              </a>
              <div class="inline">
             <!--  <a href="HotelInfo?id={{$v->h_id}}&address={{$v->h_address}}"> -->
                  <h3>{{$v->h_name}}</h3>
                  <p>地址：{{$v->h_address}}</p>
                  <p>评分：4.6 （{{$v->num}}人已评）</p>
              <!-- </a> -->
                  </div>
              <div class="clear"></div>  
               
               
               <ul class="unstyled">
                   <li><a href="HotelInfo?id={{$v->h_id}}&address={{$v->h_address}}" class="order">评价</a></li>
                   <li><a href="HotelGps?id={{$v->h_id}}" class="gps">导航</a></li>
                   <li><a href="HoteReality?id={{$v->h_id}}" class="reality">实景</a></li>
               </ul>
             </li>
        @endforeach 
            </div>
            <div class="gezifooter">
                <a href="javascript:page(1)">首页</a>
                <a href="javascript:page({{$data['last']}})">上一页</a>
                <a href="javascript:page({{$data['next']}})">下一页</a>
                <a href="javascript:page({{$data['pages']}})">尾页</a>
            </div> 
           
         </ul>
  </div>


  <div class="footer">
  <div class="gezifooter">
      
      <a href="Login" class="ui-link">立即登陆</a> <font color="#878787">|</font> 
       <a href="Register" class="ui-link">免费注册</a> <font color="#878787">|</font>                
                  

       <a href="http://www.gridinn.com/@display=pc" class="ui-link">电脑版</a>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
  </div>
  </div>

</body>
</html>
<script type="text/javascript" src="js/jq.js"></script>
<script type="text/javascript">
    function page(page)
    {
        $.get('my_order_yes',{'page':page},function(msg){
            $("#div1").html(msg);
        })
    }
</script>
















