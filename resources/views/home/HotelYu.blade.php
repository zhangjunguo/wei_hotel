<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>预定酒店</title>
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
<div class="title" id="titleString">预定酒店</div>
<a href="javascript:history.go(-1);" class="back">
            <span class="header-icon header-icon-return"></span>
            <span class="header-name">返回</span>
        </a>
 </div>

        
  <div class="container hotellistbg">
         <ul class="unstyled hotellist">
     
  <!-- style="background:url('../uploads/{{$arr->h_img}}')" -->
  <table border="2" width='600' >
    <tr>
      <td width="80">酒店名称</td>
      <td>
        <input type="text" placeholder="{{$arr->h_name}}" />
      </td>
    </tr>
    <tr>
      <td>酒店类型</td>
      <td>
        <input type="text" placeholder="{{$arr->h_type}}" />
      </td>
    </tr>
    <tr>
      <td>酒店地址</td>
      <td>
        <input type="text" placeholder="{{$arr->h_address}}"/>
      </td>
    </tr>
    <tr>
      <td>房间类型</td>
      <td>
        <input type="text" placeholder="{{$data->r_name}}" />
      </td>
    </tr>
    <tr>
      <td>房间单价</td>
      <td>
        @if($res->user_score>=4000 || $res->user_grade == 1)
          <input type="text"  placeholder="{{$data->r_vip_price}}" id="price" />
        @else
          <input type="text"  placeholder="{{$data->r_price}}" id="price" />
        @endif
      </td>
    </tr>
    <tr>
      <td>房间数量</td>
      <td>
        <input type="text" name="od_count" id="nums" value="1"  onblur="change(this)" />
      </td>
    </tr>
    <tr>
      <td>入住日期</td>
      <td>
        <input type="text" id="od_start_time" value="{{Session::get('checkInDate')}}" />
      </td>
    </tr>
    <tr>
      <td>离店日期</td>
      <td>
        <input type="text" id="od_end_time" value="{{Session::get('checkOutDate')}}" />
      </td>
    </tr>
@if($res->user_score > 0)
    <tr>
      <td>会员积分</td>
      <td>
          <input type="text"  placeholder="{{$res->user_score}}" id="score" />
          <span id="check_score">(积分最大兑换总金额的5%，100积分10元)</span>
      </td>
    </tr>
@else
  <input type="hidden" value="0" id="score" />
@endif

    <tr>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" id="h_id" value="{{$arr->h_id}}" />
    <input type="hidden" id="r_id" value="{{$data->r_id}}" />
      <td colspan="2">
        <input type="button" value="确认" id="button"/>
        订单总价：<span id="num_price">
          @if($res->user_score>=4000 || $res->user_grade == 1)
                {{$data->r_vip_price}}
          @else
                {{$data->r_price}}
          @endif
        </span>
      </td>
    </tr>
  </table>
            
           
         </ul>
  </div>


  <div class="footer">
  <div class="gezifooter">
      
        <?php if(Session::get('user_name')){ ?>
  <font color="#878787">|</font> <a href="loginout" title="退出" >退出</a>
  <?php }else{ ?>
      <a href="Login" class="ui-link">立即登陆</a> <font color="#878787">|</font> 
       <a href="Register" class="ui-link">免费注册</a> <font color="#878787">|</font>   
   <?php } ?>          
                  

       <a href="http://www.gridinn.com/@display=pc" class="ui-link">电脑版</a>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
  </div>
  </div>

</body>
</html>
<script>
  flag='a';
  $.ajaxSetup({
    async:false
  });
  function change(num){
    var price = $("#price").attr('placeholder');
    // alert(price);
    var nums = $(num).val();
    // alert(nums);
    $("#num_price").html(price*nums);
    // if(nums > {{$data->r_num}}){
    //     alert('房间没有足够的数量');
    // }
  }


  $("#button").click(function(){
      var nums = $("#nums").val();
      // alert(nums);
      var od_start_time = $("#od_start_time").val();
      var od_end_time = $("#od_end_time").val();
      var h_id = $("#h_id").val();
      var r_id = $("#r_id").val();
      var price = $("#price").attr('placeholder');
      var score = $("#score").val();
      // alert(nums);

      var num_price = $("#num_price").html();
      $.get("OrderScore",{score:score},function(e){
          if(e == 1){
            alert("当前积分不够");
            flag=false;
          }else if(e == 2){
              if(score*0.1>num_price*0.05){
                alert("不能超过总价的5%");
                flag=false;
              }else{
                $("#check_score").html("<font style='color:red'>OK</font>");
                flag=true;
              }
          }
      });
      if(nums > {{$data->r_num}}){
        alert('房间没有足够的数量');
        flag=false;
      }
      // alert(flag);
      // return false;
      if(flag == true){
          $.get("HotelOk",{nums:nums,od_start_time:od_start_time,od_end_time:od_end_time,h_id:h_id,r_id:r_id,price:price,score:score},function(e){
              if(e){
                // alert(e);
                if(confirm('马上去支付')){
                  location.href='PAY?o_num='+e;
                }else{
                  location.href='MyOrder';
                }
              }
          });
      }
  });

// 会员积分
  // function score(score){
  //     var score = $(score).val();
  //     var num_price = $("#num_price").html();
  //     $.get("OrderScore",{score:score},function(e){
  //         if(e == 1){
  //           alert("当前积分不够");
  //         }else if(e == 2){
  //             if(score*0.1>num_price*0.05){
  //               alert("不能超过总价的5%");
  //             }else{
  //               $("#check_score").html("<font style='color:red'>OK</font>");
  //             }
  //         }
  //     });
  // }
</script>

