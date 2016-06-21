<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>酒店列表</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="../home/css/bootstrap.min.css" rel="stylesheet" />
<link href="../home/css/NewGlobal.css" rel="stylesheet" />

<script type="text/javascript" src="../home/js/zepto.js"></script>
<script src="../js/jq.js"></script>

</head>
<body>
 <div class="header">
 <a href="/" class="home">
            <span class="header-icon header-icon-home"></span>
            <span class="header-name">主页</span>
</a>
<div class="title" id="titleString">酒店列表</div>
<a href="javascript:history.go(-1);" class="back">
            <span class="header-icon header-icon-return"></span>
            <span class="header-name">返回</span>
        </a>
 </div>

        
  <div class="container hotellistbg">
         <ul class="unstyled hotellist">
        
        @foreach($arr as $k => $v)
             <li>
              <a href="HotelInfo?id={{$v->h_id}}&address={{$v->h_address}}">
                 <img class="hotelimg fl" src="../uploads/{{$v->h_img}}" /> 
              </a>
              <div class="inline">
             <!--  <a href="HotelInfo?id={{$v->h_id}}&address={{$v->h_address}}"> -->
                  <h3>{{$v->h_name}}</h3>
                  <p>地址：{{$v->h_address}}</p>
                  <p>评分：4.6 （{{$v->num}}人已评）</p>
              <!-- </a> -->
                  <?php if(isset($v->collect)){ ?>
                    <span class="collect" style="color:#666666; float:right;" h_id="{{$v->h_id}}" h_state="{{$v->collect}}" cityid="{{$v->city_id}}">取消收藏</span>
              <?php }else{ ?>
        <span class="collect" style="color:#666666; float:right;" h_id="{{$v->h_id}}" h_state="0" cityid="{{$v->city_id}}">收藏</span>
              <?php } ?></div>
              <div class="clear"></div>  
               
               
               <ul class="unstyled">
                   <li><a href="HotelInfo?id={{$v->h_id}}&address={{$v->h_address}}" class="order">预订</a></li>
                   <li><a href="HotelGps?id={{$v->h_id}}" class="gps">导航</a></li>
                   <li><a href="HoteReality?id={{$v->h_id}}" class="reality">实景</a></li>
                   <!-- <li><a href="HotelColl?id={{$v->h_id}}" class="collect">收藏</a></li> -->
               </ul>
             </li>
        @endforeach  
             
           
         </ul>
  </div>


  <div class="footer">
  <div class="gezifooter">
      
      <a href="Login" class="ui-link">立即登陆</a> <font color="#878787">|</font> 
       <a href="Register" class="ui-link">免费注册</a> <font color="#878787">|</font>                
                  

       <a href="http://www.gridinn.com/@display=pc" class="ui-link">电脑版</a>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
  </div>
  </div>

</body>
</html>
<script>
  $(function(){
    $(".collect").click(function(){
      // alert(h_id);
      // alert(text);
      var h_id = $(this).attr('h_id');
      var text = $(this).attr('h_state');
      var city_id = $(this).attr('cityid');
      // alert(city_id);
      if(text == 0){
          $.get("HotelCollect",{"h_id":h_id},function(e){
            if(e == 1){
              alert('请先登录');
            }else if(e == 2){
              $(this).html('取消收藏');
              location.href='HotelList?cityID='+city_id;
            }
          });
        }else if(text == 1){
           $.get("HotelCollectDel",{"h_id":h_id},function(e){
                    if(e == 1){
                      $(this).html('收藏');
                      location.href='HotelList?cityID='+city_id;
                    }
            });
        }
    });
  });
</script>
