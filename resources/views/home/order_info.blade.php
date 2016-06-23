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
            <div class="title" id="titleString">订单信息</div>
            <a href="javascript:history.go(-1);" class="back">
                <span class="header-icon header-icon-return"></span>
                <span class="header-name">返回</span></a>
        </div>
        <div class="container width80 pt20">
            <form name="aspnetForm" method="post" action="login.aspx?ReturnUrl=%2fMember%2fDefault.aspx" id="aspnetForm" class="form-horizontal">
                <ul class="user-function-list">
                    <li style="text-align:left">酒店：{{$data->h_name}}</li>
                    
                    <li style="text-align:left">房型：{{$data->r_name}}</li>
                    <li style="text-align:left">订单状态: 
                    
                    <?php 
                    if($data->o_state ==1){ 
                        echo "已预定，未付款";
                    }elseif($data->o_state ==2){ 
                        echo "已预订,已付款,未消费";
                    }elseif($data->o_state == 3){
                        echo "已付款,已消费";
                    }elseif($data->o_state == 4){
                        echo "已退订";
                    }
                    ?>
                   


                    </li>
                    <li style="text-align:left">下单时间: {{date('Y-m-d H:i:s',$data->o_addtime)}}</li>
                    <li style="text-align:left">酒店电话：{{$data->h_tel}}</li>
                    <li style="text-align:left">酒店描述：{{$data->h_desc}}</li>
                    
                </ul>
            </form>
        </div>
        <div class="footer">
            <div class="gezifooter">
                <p style="color:#bbb;">1408phpF4组 &copy; 版权所有 2012-2016</p></div>
        </div>
    </body>

</html>