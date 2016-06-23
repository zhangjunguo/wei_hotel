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
<style>
    #img_box{ width: 100%; height: 240px;  overflow: hidden; position: relative; }
    #img_list{ list-style: none; position: relative; width: 1200px}
    #img_list li{ float: left;}
</style>
</head>
<body>
  
 <div class="container">
 <div class="header">
 <img src="home/img/logo.png" style="height: 40px; margin: 10px 0px 10px 15px" />
 </div>
 <div id="img_box">
      <ul id="img_list">
        @foreach ($arr as $k => $v)
          <li id="img_{{$k+1}}" img-no="{{$k+1}}"><a href="home/HotelInfo?id={{$v->h_id}}"><img src="/uploads/{{$v->h_img}}" width="505px" height="200px" style="margin-left:-25px" /></a></li>
        @endforeach
      </ul>
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
 <input type="hidden" value="{{Session::get('user_id')}}">
<div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >免费模板</a></div>

  <div class="footer">
  <div class="gezifooter"> <a href="home/Hotel" class="ui-link">酒店预订</a> <font color="#878787">|</font> <a href="home/Login" class="ui-link">我的订单</a> <font color="#878787">|</font> <a href="home/Login" class="ui-link">我的格子</a> 
  <?php if(Session::get('user_name')){ ?>
  <font color="#878787">|</font> <a href="home/loginout" title="退出" >退出</a>
  <?php }else{ ?>
   <font color="#878787">|</font> <a href="home/Login" title="登录" >登陆</a>
   <font color="#878787">|</font> <a href="home/Register" title="注册" >注册</a>
  <?php } ?>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2013</p>
  </div>
  </div>
</body>
</html>

<script type="text/javascript" src="js/jq.js"></script>
<script type="text/javascript">
    $(function(){
        var user_id = $(":input[type='hidden']").val();
        if(user_id){
            $.get("user_info",{'user_id':user_id},function(msg){
                if(msg == 1){
                    if(confirm("您的个人信息未完善,建议及时完善")){
                        location.href="home/MyInfo";
                    }
                }
            }) 
        }            
    })
</script>

<script src="/jq.js"></script>
<script>

var fn;

$(function(){

    startEvent();

    // 鼠标滑过
    $('#img_box').on({
        mouseover : function() {
            clearEvent();
        },
        mouseout : function() {
            startEvent();
        }
    });

    // 鼠标点击
    $('#order_list li').on({
        click : function() {
            var order = $(this).attr('order');
            $('#img_list li').css('margin-left', '0');
            eachMoveImg(order);
            $(this).find('a').css('color', 'red');
            $(this).siblings('li').find('a').css('color', '#000');
        },
        mouseover : function() {
            clearEvent();
        },
        mouseout : function() {
            startEvent();
        }
    });

});

// 轮播
function slide()
{
    $('#img_list li:first').animate({
        marginLeft : '-480px'
    }, 1500, function(){
        $(this).css('margin-left', '0').appendTo('#img_list');
        var imgNo = parseInt( $(this).attr('img-no') ) + 1;
        if (imgNo == 5) {
            imgNo = 1;
        }
        $('#order_list li').find('a').css('color', '#000');
        $('#order_' + imgNo).find('a').css('color', 'red')
    });
}

// 启动轮播事件
function startEvent()
{
    fn = setInterval('slide()', 5000);
}

// 清除轮播事件
function clearEvent()
{
    clearInterval(fn);
}

// 遍历移动图片位置
function eachMoveImg(order)
{
    var imgNo;
    $('#img_list li').each(function(){
        imgNo = $(this).attr('img-no');
        if (imgNo == order) {
            return false;
        }
        $(this).appendTo('#img_list');
    });
}
</script>

