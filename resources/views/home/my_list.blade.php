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
            <div class="title" id="titleString">我的信息</div>
            <a href="javascript:history.go(-1);" class="back">
                <span class="header-icon header-icon-return"></span>
                <span class="header-name">返回</span></a>
        </div>
        <div class="container width80 pt20">
            <form name="aspnetForm" method="post" action="MyInfo" id="aspnetForm" class="form-horizontal" onsubmit="return sub()">
                <ul class="user-function-list">
                    <li style="text-align:left">昵称：<input type="text" name="user_name" value="{{$data->user_name}}" onblur="sp1()" /><span id="sp1"></span></li>
                    
                    <li style="text-align:left">手机号：{{$data->user_phone}}</li>
                    <li style="text-align:left">邮箱：{{$data->user_email}}</li>
                    @if($data->user_card == '')
                        <li style="text-align:left">身份证号：<input type="text" name="user_card" value="{{$data->user_card}}" onclick="sp2()" /></li>
                        <span id="sp2"></span>
                    @else
                        <li style="text-align:left">身份证号：{{$data->user_card}}</li>
                    @endif
                </ul>
                <input type="hidden" class="form-control" name="_token" value="<?php echo csrf_token(); ?>" />
                <input type="submit" class="submit-button" value="提交" style="width: 100%; height: 45px; background: #6ac134; color: #fff; border: 1px solid #6ac134" />
            </form>
        </div>
        <div class="footer">
            <div class="gezifooter">
                <p style="color:#bbb;">1408phpF4组 &copy; 版权所有 2012-2016</p></div>
        </div>
    </body>

</html>
<script>
    function sp1()
    {
        var uname = document.getElementsByName('user_name')[0].value;
        //alert(uname);
        var sp = document.getElementById('sp1');
        if (uname == '') {
            sp.style.color = 'red';
            //alert('123');
            sp.innerHTML = '不能为空';
            return false;
        } else {
            sp.innerHTML = '';
            return true;
        }
    }

    function sp2()
    {
        var card = document.getElementsByName('user_card')[0].value;
        var sp = document.getElementById('sp2');

        if(card == ''){
            sp.style.color = 'red';
            sp.innerHTML = '不能为空';
            return false;
        }else{
            var reg = /^(\d{18})|(\d{17}x)$/;
            if(reg.test(card)){
                sp.innerHTML = '';
                return true;
            }else{
                sp.style.color = 'red';
                sp.innerHTML = '格式不对';
                return false;
            }
        }
    }

    function sub()
    {
        if(sp1()&sp2()){
            return true;
        }else{
            return false;
        }
    }
</script>