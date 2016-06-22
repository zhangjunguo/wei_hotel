<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>我的格子</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <link href="../home/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../home/css/NewGlobal.css" rel="stylesheet" />
        <link href="../home/css/user.css" rel="stylesheet" />
        <script type="text/javascript" src="../home/js/zepto.js"></script>
    </head>
    
    <body>
        <div class="header">
            <a href="/" class="home">
                <span class="header-icon header-icon-home"></span>
                <span class="header-name">主页</span></a>
            <div class="title" id="titleString">我的格子</div>
            <a href="javascript:history.go(-1);" class="back">
                <span class="header-icon header-icon-return"></span>
                <span class="header-name">返回</span></a>
        </div>
        <div class="container width80 pt20">
            <div class="user-face" onclick="alertWin('头像上传','内容',300,200)" style="z-index:100">
                <img src="/uploads/User/{{$data->user_img}}" alt="" />
            </div>

            <div class="user-list">
                <span class="user-name">{{$data->user_name}}</span>
                <span class="user-integer">积分:<i>{{$data->user_score}}</i></span>
            </div>

            <ul class="user-function-list">
                <li onclick="javascript:location.href='MyInfo';">我的信息</li>
                <li onclick="javascript:location.href='MyOrder';">我的订单</li>
                <li onclick="javascript:location.href='MyGift';">我的礼品</li>
                <li onclick="javascript:location.href='MyCollection';">我的收藏</li>
            </ul>
        </div>
        <div class="footer">
            <div class="gezifooter">
                <p style="color:#bbb;">1408phpF4组 &copy; 版权所有 2012-2016</p>
            </div>
        </div>
    </body>

</html>
<script language="javascript">  
function alertWin(title, msg, w, h){
var content ="<form action='UserImg' method='post' enctype='multipart/form-data'>";
content += "<br/><br/><input type='file' name='file' id='file' value='浏览'/>";  
content += "<br/><p align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>*</font>上传头像</p>";  
content += "<input type='hidden' class='form-control' name='_token' value='<?php echo csrf_token(); ?>' />";
content += "<input type='submit' value='提交'/>";
content += "</form>";  
msg = content;  
var titleheight = "22px"; // 提示窗口标题高度  
var bordercolor = "#666699"; // 提示窗口的边框颜色  
var titlecolor = "#FFFFFF"; // 提示窗口的标题颜色  
var titlebgcolor = "#00FF00"; // 提示窗口的标题背景色  
var bgcolor = "#FFFFFF"; // 提示内容的背景色  
  
var iWidth = document.documentElement.clientWidth;  
var iHeight = document.documentElement.clientHeight;  
var bgObj = document.createElement("div");  
bgObj.style.cssText = "position:absolute;left:0px;top:0px;width:"+iWidth+"px;height:"+Math.max(document.body.clientHeight, iHeight)+"px;filter:Alpha(Opacity=30);opacity:0.3;background-color:#000000;z-index:101;";  
document.body.appendChild(bgObj);  
  
var msgObj=document.createElement("div");  
msgObj.style.cssText = "position:absolute;font:11px '宋体';top:"+(iHeight-h)/2+"px;left:"+(iWidth-w)/2+"px;width:"+w+"px;height:"+h+"px;text-align:center;border:1px solid "+bordercolor+";background-color:"+bgcolor+";padding:1px;line-height:22px;z-index:102;";  
document.body.appendChild(msgObj);  
  
var table = document.createElement("table"); //www.divcss5.com divcss5  
msgObj.appendChild(table);  
table.style.cssText = "margin:0px;border:0px;padding:0px;";  
table.cellSpacing = 0;  
var tr = table.insertRow(-1);  
var titleBar = tr.insertCell(-1);  
titleBar.style.cssText = "width:100%;height:"+titleheight+"px;text-align:left;padding:3px;margin:0px;font:bold 13px '宋体';color:"+titlecolor+";border:1px solid " + bordercolor + ";cursor:move;background-color:" + titlebgcolor;  
titleBar.style.paddingLeft = "10px";  
titleBar.innerHTML = title;  
var moveX = 0;  
var moveY = 0;  
var moveTop = 0;  
var moveLeft = 0;  
var moveable = false;  
var docMouseMoveEvent = document.onmousemove; //www.divcss5.com divcss5  
var docMouseUpEvent = document.onmouseup;  
titleBar.onmousedown = function() {  
var evt = getEvent();  
moveable = true;  
moveX = evt.clientX;  
moveY = evt.clientY;  
moveTop = parseInt(msgObj.style.top);  
moveLeft = parseInt(msgObj.style.left);  
  
document.onmousemove = function() {  
if (moveable) {  
var evt = getEvent();  
var x = moveLeft + evt.clientX - moveX; //www.divcss5.com divcss5  
var y = moveTop + evt.clientY - moveY;  
if ( x > 0 &&( x + w < iWidth) && y > 0 && (y + h < iHeight) ) {  
msgObj.style.left = x + "px";  
msgObj.style.top = y + "px";  
}  
}  
};  
document.onmouseup = function () {  
if (moveable) {  
document.onmousemove = docMouseMoveEvent; //www.divcss5.com divcss5  
document.onmouseup = docMouseUpEvent;  
moveable = false;  
moveX = 0;  
moveY = 0;  
moveTop = 0;  
moveLeft = 0;  
}  
};  
  
}  
  
var closeBtn = tr.insertCell(-1);  
closeBtn.style.cssText = "cursor:pointer; padding:2px;background-color:" + titlebgcolor;  
closeBtn.innerHTML = "<span style='font-size:15pt; color:"+titlecolor+";'>×</span>";  
//关闭窗口  
closeBtn.onclick = function(){  
document.body.removeChild(bgObj);  
document.body.removeChild(msgObj);  
}  
var msgBox = table.insertRow(-1).insertCell(-1);  
msgBox.style.cssText = "font:10pt '宋体';";  
msgBox.colSpan = 2;  
msgBox.innerHTML = msg;  
  
// 获得事件Event对象，用于兼容IE和FireFox  
function getEvent() {  
return window.event || arguments.callee.caller.arguments[0];  
}  
}  
</script> 