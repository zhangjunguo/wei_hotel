<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    
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
    
    <body id="div1">
        <div class="header">
            <a href="/" class="home">
                <span class="header-icon header-icon-home"></span>
                <span class="header-name">主页</span></a>
            <div class="title" id="titleString">手机找回</div>
            <a href="javascript:history.go(-1);" class="back">
                <span class="header-icon header-icon-return"></span>
                <span class="header-name">返回</span></a>
        </div>
        <div class="container width80 pt20">
            <div class="order-nav">
                
            <form method="post" action="pwd_phone_method" id="aspnetForm" class="form-horizontal">
                <ul class="user-function-list">
                    <li style="text-align:left">手机号:<input type="text" id="phone" name="phone"></li>
                    <li style="text-align:left">验证码:<input type="text" name="code" ><input type="button" id="but" value="获取验证码"></li>
                    <li style="text-align:left">新密码:<input type="password" name="user_pass"></li>
                    <li style="text-align:left">确认密码:<input type="password" name="check_pass" ></li>
                </ul>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="control-group">
         <button onClick="__doPostBack('ctl00$ContentPlaceHolder1$btnOK','')" id="ctl00_ContentPlaceHolder1_btnOK" class="btn-large green button width100">立即找回</button>

        </div>
            </form>

            </div>
        </div>
        <div class="footer">
            <div class="gezifooter">
                <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript" src="../js/jq.js"></script>
<script type="text/javascript">

    $("#but").click(function(){
        var phone = $("#phone").val();
        $.get('send_code',{'phone':phone})
    })
</script>