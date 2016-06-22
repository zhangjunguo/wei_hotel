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
            <div class="title" id="titleString">我的订单</div>
            <a href="javascript:history.go(-1);" class="back">
                <span class="header-icon header-icon-return"></span>
                <span class="header-name">返回</span></a>
        </div>
        <div class="container width80 pt20">
            <div class="order-nav">
                <a  href="MyOrder">全部</a>
                <a class="last-a" href="my_order_no">未完成</a>
                <a class="selected" href="my_order_yes">已完成</a>
            </div>
            
            <div class="order-list">
            <ul>
                <li>
                    <span class="order-hotel-name">酒店名称</span>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <span>前往评论</span class="order-hotel-name">
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <span class="order-name">下单时间</span>
                </li>
            </ul>
            @foreach($data['data'] as $v)
                <ul>
                    <li>
                        <a href="order_info?id={{$v->o_id}}"><span class="order-hotel-name">{{$v->h_name}}</span></a>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <a href="">去评论</a>
                        <span class="order-time">{{date('Y-m-d H:i:s',$v->o_addtime)}}</span>
                    </li>
                </ul>
            
            @endforeach
            <div class="container width80 pt20">
                <a href="javascript:page(1)">首页</a>
                <a href="javascript:page({{$data['last']}})">上一页</a>
                <a href="javascript:page({{$data['next']}})">下一页</a>
                <a href="javascript:page({{$data['pages']}})">尾页</a>
            </div>
            </div>
        </div>
        <div class="footer">
            <div class="gezifooter">
                <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript" src="js/jq.js"></script>
<script type="text/javascript">
    function page(page)
    {
        $.get('my_order_yes',{'page':page},function(msg){
            $("#div1").html(msg);
        })
    }
</script>