<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>酒店列表</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="../home/css/bootstrap.min.css" rel="stylesheet" />
<link href="../home/css/NewGlobal.css" rel="stylesheet" />
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=0Q4ukkWliKkZWZGl03OkKWCu5UUfPL5S"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />

<script type="text/javascript" src="js/zepto.js"></script>
<style>
 #allmap {height: 500px;width:100%;overflow: hidden;}
  #result {width:100%;font-size:12px;}
  dl,dt,dd,ul,li{
    margin:0;
    padding:0;
    list-style:none;
  }
  dt{
    font-size:14px;
    font-family:"微软雅黑";
    font-weight:bold;
    border-bottom:1px dotted #000;
    padding:5px 0 5px 5px;
    margin:5px 0;
  }
  dd{
    padding:5px 0 0 5px;
  }
  li{
    line-height:28px;
  }


#main { 

height:1800px; 
padding-top:90px; 
text-align:center; 
} 
#fullbg { 

left:0; 
opacity:0.5; 
position:absolute; 
top:0; 
z-index:3; 
filter:alpha(opacity=50); 
-moz-opacity:0.5; 
-khtml-opacity:0.5; 
} 
#dialog { 
background-color:#fff; 
border:5px solid rgba(0,0,0, 0.4); 
height:400px; 
left:50%; 
margin:-200px 0 0 -200px; 
padding:1px; 
position:fixed !important; /* 浮动对话框 */ 
position:absolute; 
top:50%; 
width:400px; 
z-index:5; 
border-radius:5px; 
display:none; 
} 
#dialog p { 
margin:0 0 12px; 
height:24px; 
line-height:24px; 
background:#CCCCCC; 
} 
#dialog p.close { 
text-align:right; 
padding-right:10px; 
} 
#dialog p.close a { 
color:#fff; 
text-decoration:none; 
} 
</style>
</head>
<body>
 <div class="header">
 <a href="/" class="home">
            <span class="header-icon header-icon-home"></span>
            <span class="header-name">主页</span>
</a>
<div class="title" id="titleString">酒店导航</div>
<a href="javascript:history.go(-1);" class="back">
            <span class="header-icon header-icon-return"></span>
            <span class="header-name">返回</span>
        </a>
 </div>

        
  <div class="container hotellistbg">
    <div id="allmap"> 
  </div>
  <div id="result">
    <input type="button"  onclick="searchInfoWindow.open(marker);"/>
    
  </div>
  </div>

<script type="text/javascript"> 
//显示灰色 jQuery 遮罩层 
function showBg() { 
var bh = $("body").height(); 
var bw = $("body").width(); 
$("#fullbg").css({ 
height:bh, 
width:bw, 
display:"block" 
}); 
$("#dialog").show(); 
} 
//关闭灰色 jQuery 遮罩 
function closeBg() { 
$("#fullbg,#dialog").hide(); 
} 
</script>
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
  // 百度地图API功能
    var map = new BMap.Map('allmap');
    var poi = new BMap.Point({{$arr->h_x}},{{$arr->h_y}});
    map.centerAndZoom(poi, 16);
    map.enableScrollWheelZoom();

    var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
                    '<img src="../img/baidu.jpg" alt="" style="float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;"/>' +
                    '地址：{{$arr->h_address}}<br/>电话：{{$arr->h_tel}}<br/>简介：{{$arr->h_desc}}' +
                  '</div>';

    //创建检索信息窗口对象
    var searchInfoWindow = null;
  searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
      title  : "{{$arr->h_name}}",      //标题
      width  : 290,             //宽度
      height : 105,              //高度
      panel  : "panel",         //检索结果面板
      enableAutoPan : true,     //自动平移
      searchTypes   :[
        BMAPLIB_TAB_SEARCH,   //周边检索
        BMAPLIB_TAB_TO_HERE,  //到这里去
        BMAPLIB_TAB_FROM_HERE //从这里出发
      ]
    });
    var marker = new BMap.Marker(poi); //创建marker对象
    marker.enableDragging(); //marker可拖拽
    marker.addEventListener("click", function(e){
      searchInfoWindow.open(marker);
    })
    map.addOverlay(marker); //在地图中添加marker

</script>