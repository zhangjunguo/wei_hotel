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
            <div class="order-nav">
                <a class="selected" href="">全部</a>
                <a href="">未完成</a>
                <a class="last-a" href="">已完成</a>
            </div>

            <div class="order-list">
                <ul>
                    @foreach ($data as $v)
                    <li>
                        <span class="order-hotel-name">{{$v->g_name}}</span>
                        <span class="order-time">{{date('Y-m-d H:i:s', $v->go_time)}}</span>
                    </li>
                    @endforeach
                </ul>
                <?php echo $data->render();?>
            </div>
        </div>
        <div class="footer">
            <div class="gezifooter">
                <p style="color:#bbb;">1408phpF4组 &copy; 版权所有 2012-2016</p>
            </div>
        </div>
    </body>

</html>