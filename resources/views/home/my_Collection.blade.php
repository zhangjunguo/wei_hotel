<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>我的格子</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/NewGlobal.css" rel="stylesheet" />
        <link href="css/user.css" rel="stylesheet" />
        <script type="text/javascript" src="js/zepto.js"></script>
        <script type="text/javascript" src="js/jq.js"></script>
    </head>
    
    <body>
        <div class="header" >
            <a href="index.html" class="home">
                <span class="header-icon header-icon-home"></span>
                <span class="header-name">主页</span></a>
            <div class="title" id="titleString">我的收藏</div>
            <a href="javascript:history.go(-1);" class="back">
                <span class="header-icon header-icon-return"></span>
                <span class="header-name">返回</span></a>
        </div>
        <div class="container width80 pt20" id="div1">
            <div class="order-nav" style="text-align:left;">
                <!-- <a class="selected" href="">全部</a> -->
                <span style="color:#367517">已收藏的酒店:</span>
                <!-- <a class="last-a" href="">已完成</a> -->
            </div>

            <div class="order-list">
            
                <ul>
                   @foreach($results as $v)
                    <li>
                        <span class="collect_order">{{$v->col_id}}  &nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="order-hotel-name">
                        <img src="../uploads/{{$v->h_img}}" alt="无法显示" width="50px" height="50px"/>
                        <a href="home/HotelInfo?id={{$v->h_id}}">{{$v->h_name}}</a>
                        </span>
                        <span class="order-time">{{$v->col_time}}</span>
                    </li>
                    @endforeach
                </ul>
           </div>
        </div>
        <div class="footer">
            <div class="gezifooter">
                <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
            </div>
        </div>
    </body>
     
</html>
