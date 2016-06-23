<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>酒店列表</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="../home/css/bootstrap.min.css" rel="stylesheet" />
<link href="../home/css/NewGlobal.css" rel="stylesheet" />
<style type="text/css">
    body, html {width: 100%;height: 100%;margin:0 auto;font-family:"微软雅黑";}
    #allmap{width:100%;height:500px;}
    p{margin-left:5px; font-size:14px;}
  </style>
<script type="text/javascript" src="../home/js/zepto.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=0Q4ukkWliKkZWZGl03OkKWCu5UUfPL5S"></script>
</head>
<body>
 <div class="header">
 <a href="/" class="home">
            <span class="header-icon header-icon-home"></span>
            <span class="header-name">主页</span>
</a>
<div class="title" id="titleString">酒店列表</div>
<a href="javascript:history.go(-1);" class="back">
            <span class="header-icon header-icon-return"></span>
            <span class="header-name">返回</span>
        </a>
 </div>

        
  <div class="container hotellistbg">
         <ul class="unstyled hotellist">

            <div id="allmap"></div>
          
           
         </ul>
  </div>


  <div class="footer">
  <div class="gezifooter">
      
        <?php if(Session::get('user_name')){ ?>
  <font color="#878787">|</font> <a href="loginout" title="退出" >退出</a>
  <?php }else{ ?>
      <a href="Login" class="ui-link">立即登陆</a> <font color="#878787">|</font> 
       <a href="Register" class="ui-link">免费注册</a> <font color="#878787">|</font>   
   <?php } ?>              
                  

       <a href="http://www.gridinn.com/@display=pc" class="ui-link">电脑版</a>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
  </div>
  </div>

</body>
</html>
<script type="text/javascript">
    var sContent =

"<h4 style='margin:0 0 5px 0;padding:0.2em 0'>{{$arr->h_name}}</h4>" +



"<p style='margin:0;line-height:1.5;font-size:13px;text-indent:2em'>{{$arr->h_beizhu}}</p>" +

"</div>";

    var map = new BMap.Map("allmap");

    var point = new BMap.Point({{$arr->h_x}},{{$arr->h_y}});

    var marker = new BMap.Marker(point);

    var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象

    map.centerAndZoom(point, 15);

    map.addOverlay(marker);

    marker.addEventListener("click", function(){

        this.openInfoWindow(infoWindow);

        //图片加载完毕重绘infowindow

        document.getElementById('imgDemo').onload = function (){

            infoWindow.redraw();   //防止在网速较慢，图片未加载时，生成的信息框高度比图片的总高度小，导致图片部分被隐藏

        }

    });

</script>

</script>

