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
    body, html{width: 100%;height: 100%;margin:0 auto;font-family:"微软雅黑";}
    #panorama {width:100%; height: 500px;}
    #result {width:100%;font-size:12px;}
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

        <div id="panorama"></div>
  <div id="result">
    <button id="hideNavigationControl">隐藏导航控件</button>
    <button id="showNavigationControl">显示导航控件</button>
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
<script type="text/javascript">
  var panorama = new BMap.Panorama('panorama'); //默认为显示导航控件 
  panorama.setPosition(new BMap.Point({{$arr->h_x}}, {{$arr->h_y}}));

  document.getElementById("hideNavigationControl").onclick = function(){ 
    panorama.setOptions({
      navigationControl: false //隐藏导航控件
    });
  };
  document.getElementById("showNavigationControl").onclick = function(){ 
    panorama.setOptions({
      navigationControl: true //显示导航控件
    });
  };
</script>
