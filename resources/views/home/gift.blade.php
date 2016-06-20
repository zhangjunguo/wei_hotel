<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>礼品中心</title>
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
<div class="title" id="titleString">礼品中心</div>
<a href="javascript:history.go(-1);" class="back">
            <span class="header-icon header-icon-return"></span>
            <span class="header-name">返回</span>
        </a>
 </div>

        
   <form  method="post" action="../exchangeGift" >
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJMjUyMzU2NTUzD2QWAmYPZBYCAgEPZBYCAgEPZBYCAgEPZBYGZg8PFgIeBFRleHQFD+iQqOaRqeWFheeUteWunWRkAgEPDxYCHwAFBDk2MDBkZAICDxYCHwAF4Qc8cCBzdHlsZT0idGV4dC1pbmRlbnQ6MHB4O2NvbG9yOiM5OTk5OTk7Ij4NCgk8ZW0+PHN0cm9uZz7kuqflk4Hlj4LmlbDvvJo8L3N0cm9uZz48L2VtPg0KPC9wPg0KPHVsIHN0eWxlPSJ0ZXh0LWluZGVudDowcHg7Y29sb3I6IzQwNDA0MDsiPg0KCTxsaSBzdHlsZT0iY29sb3I6IzY2NjY2Njt2ZXJ0aWNhbC1hbGlnbjp0b3A7Ij4NCgkJ5ZOB54mMOiZuYnNwO2VtaWUv5Lq/6KeF44CCDQoJPC9saT4NCgk8bGkgc3R5bGU9ImNvbG9yOiM2NjY2NjY7dmVydGljYWwtYWxpZ246dG9wOyI+DQoJCeWei+WPtzombmJzcDtlbWll6JCo5pGp56e75Yqo55S15rqQDQoJPC9saT4NCgk8bGkgc3R5bGU9ImNvbG9yOiM2NjY2NjY7dmVydGljYWwtYWxpZ246dG9wOyI+DQoJCeminOiJsuWIhuexuzombmJzcDvpu4ToibLokKjmkakmbmJzcDvnmb3oibLokKjmkakr6aaZ5riv5r2u6ZuG5YWF55S15aS0Jm5ic3A76buE6Imy6JCo5pGpK+mmmea4r+a9rumbhuWFheeUteWktCZuYnNwO+eZveiJsuiQqOaRqQ0KCTwvbGk+DQoJPGxpIHN0eWxlPSJjb2xvcjojNjY2NjY2O3ZlcnRpY2FsLWFsaWduOnRvcDsiPg0KCQnnlLXmsaDlrrnph486Jm5ic3A7NTAwMU1BaCjlkKspLTYwMDBNQWgo5ZCrKQ0KCTwvbGk+DQoJPGxpIHN0eWxlPSJjb2xvcjojNjY2NjY2O3ZlcnRpY2FsLWFsaWduOnRvcDsiPg0KCQnmmK/lkKbmlK/mjIHlpKrpmLPog706Jm5ic3A75ZCmDQoJPC9saT4NCgk8bGkgc3R5bGU9ImNvbG9yOiM2NjY2NjY7dmVydGljYWwtYWxpZ246dG9wOyI+DQoJCemAgueUqOexu+WeizombmJzcDvpgJrnlKgNCgk8L2xpPg0KCTxsaSBzdHlsZT0iY29sb3I6IzY2NjY2Njt2ZXJ0aWNhbC1hbGlnbjp0b3A7Ij4NCgkJTEVE54Gv54Wn5piOOiZuYnNwO+WQpg0KCTwvbGk+DQoJPGxpIHN0eWxlPSJjb2xvcjojNjY2NjY2O3ZlcnRpY2FsLWFsaWduOnRvcDsiPg0KCQnnlLXmsaDnsbvlnos6Jm5ic3A76ZSC55S15rGgDQoJPC9saT4NCjwvdWw+DQo8cD4NCgkmbmJzcDsNCjwvcD5kZHUtAGPcaINW5BgtgZf7KsDAZt1n" />
</div>

<div>

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWAgLgkbuuCQKI+JrmBf+Ul372cpCvOJOEI7fXW4euRKUJ" />
</div>
   <div id="ctl00_ContentPlaceHolder1_Panel1">
	
        <div class="container width90">
        <h3><span  name="g_name">{{$onegift_data->g_name}}</span></h3>
        <p>所需积分：<span>{{$onegift_data->g_score}}</span></p>
        <p><img style="display: block;" src="../storage/uploads/{{$onegift_data->g_img}}" height="300" width="300"></p>
        <p><p style="text-indent:0px;color:#999999;">
                <input type="hidden" name="g_id" value="{{$onegift_data->g_id}}"/>
                <input type="hidden" name="g_score" value="{{$onegift_data->g_score}}"/>
                <input type="hidden" name="g_name" value="{{$onegift_data->g_name}}"/>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <em><strong>产品描述：</strong></em>
</p>

<p>&nbsp;
	{{$onegift_data->g_text}}
</p></p>

            
        <div class="control-group tc">
             <p class="red"></p> 
      <input type="submit"  value="立即兑换"  class="btn-large green button width80" style="width:80%;" />
        </div>
    </div>
   
</div>
   

    </form>


  <div class="footer">
  <div class="gezifooter">
      
      <a href="Login" class="ui-link">立即登陆</a> <font color="#878787">|</font> 
       <a href="Register" class="ui-link">免费注册</a> <font color="#878787">|</font>                 
                  

       <a href="../www.gridinn.com/@display=pc" class="ui-link">电脑版</a>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
  </div>
  </div>

</body>
</html>
