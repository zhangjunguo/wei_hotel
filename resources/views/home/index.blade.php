<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>格子酒店</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
<meta content="yes" name="apple-mobile-web-app-capable" />

<link href="../home/css/bootstrap.min.css" rel="stylesheet" />
<link href="../home/css/NewGlobal.css" rel="stylesheet" />

<script src="../home/js/jquery-1.7.2.min.js"></script>
<script src="../home/js/bootstrap.min.js"></script>

</head>
<body>
 
 <div class="container">
 <div class="header">
 <img src="home/img/logo.png" style="height: 40px; margin: 10px 0px 0px 15px" />
 </div>
     <div style="padding:0 5px 0 0;">
      
     <ul class="unstyled defaultlist pt20">
         <li class="f">
             <a href="home/Hotel">
             <h3>皮卡丘</h3>
             <figure class="jp_icon"></figure>
             </a>
         </li>
         <li class="h">
             <a href="home/Activity">
              <h3>最新活动</h3>
              <figure class="jd_icon"></figure>
              </a>
         </li>
     </ul>
     <ul class="unstyled defaultlist">
         <li class="a">
             <a href="home/MyOrder">
                  <h3>我的订单</h3>
              <figure class="hb_icon"></figure>
             </a>
             
         </li>
         <li class="p">
            <a href="home/MyAccount">
            <h3> 我的格子</h3>
            <figure class="mp_icon"></figure>
            </a>
         </li>
     </ul>
     <ul class="unstyled defaultlist">
         <li class="t">
            <a href="home/Gift">
            <h3> 礼品商城</h3>
            <figure class="hcp_icon"></figure>
            </a>
         </li>
         
         <li class="m">
             <a href="home/Help">
            <h3> 帮助咨询</h3>
            <figure class="wdxc_icon"></figure>
              </a>
         </li>
     </ul>
     </div>
 </div>    
 <!--  <div class="copyrights"> <a href="http://www.cssmoban.com/" >免费模板</a></div> -->
  <div class="footer">
  <div class="gezifooter"> <a href="home/Hotel" class="ui-link">酒店预订</a> <font color="#878787">|</font> <a href="home/Login" class="ui-link">我的订单</a> <font color="#878787">|</font> <a href="home/Login" class="ui-link">我的格子</a> 
  <?php if(Session::get('user_name')){ ?>
  <font color="#878787">|</font> <a href="home/loginout" title="退出" >退出</a>
  <?php } ?>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2013</p>
  </div>
  </div>
  
  
</body>
</html>
