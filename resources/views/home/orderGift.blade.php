<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>礼品中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="../home/css/bootstrap.min.css" rel="stylesheet" />
<link href="../home/css/NewGlobal.css" rel="stylesheet" />

<script type="text/javascript" src="../home/js/zepto.js"></script>

</head>
<body>
 <div class="header">
 <a href="/" class="home">
            <span class="header-icon header-icon-home"></span>
            <span class="header-name">主页</span>
</a>
<div class="title" id="titleString">礼品中心</div>
<a href="javascript:history.go(-1);" class="back">
            <span class="header-icon header-icon-return"></span>
            <span class="header-name">返回</span>
        </a>
 </div>

<center>
   <form  method="post" action="../exchangeOrder" onsubmit="return check()" >
       <h1>{{$order_data['g_name']}}</h1>
       <input type="hidden" name="g_name" value="{{$order_data['g_name']}}"/>
       <table>
           <tr>
               <th>所需积分</th>
               <td width="100px" style="text-align: center; color: #339900;font-size: xx-large">{{$order_data['go_score']}}积分</td>
               <input type="hidden" name="go_score" value="{{$order_data['go_score']}}"/>
               <input type="hidden" name="g_id" value="{{$order_data['g_id']}}"/>
           </tr>
           <tr>
               <th>收货地址</th>
               <td width="100px" style="text-align: center">
                   <select name="province" id="province" onchange="pro_change(this)">
                       <option value="">请选择</option>
                   </select>
                   <select name="city" id="city" onchange="city_change(this)">
                       <option value="">请选择</option>
                   </select>
                   <select name="county" id="county">
                       <option value="">请选择</option>
                   </select>
               </td>
           </tr>
           <tr>
               <th>详细地址</th>
               <td width="100px" style="text-align: center">
                   <input type="text" name="addre" id="addre" onblur="check_addre()"/>
                   <span id="show_addre"></span>
               </td>
           </tr>
           <tr>
               <th>手机号</th>
               <td width="100px" style="text-align: center">
                   <input type="text" name="phone" id="phone" onblur="check_phone()"/>
                   <span id="show_phone"></span>
               </td>
           </tr>
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <tr>
               <td align="center"><input type="submit"  class="btn btn-success btn-large"  value="下单"/></td>
           </tr>
       </table>
    </form>
</center>
 <script src="js/jq.js"></script>
 <script>
     function check_phone(){
        var phone =  $("#phone").val();
         if(phone == ''){
             alert("你好,手机号没填哦");
             return false;
         }

         var preg = /^0{0,1}(13[0-9]|15[0-9]|153|156|18[5-9])[0-9]{8}$/;
         if(preg.test(phone)){
            $('#show_phone').html('ok');
             return true;
         }else{
             $('#show_phone').html("手机号格式不对");
             return false;
         }
     }

     function check_addre(){
         var addre =  $("#addre").val();
         if(addre == ''){
             alert("你好,地址没填哦");
             return false;
         }

         var preg = /^[\u4E00-\u9FA5]{5,10}$/;
         if(preg.test(addre)){
             $('#show_addre').html('ok');
             return true;
         }else{
             $('#show_addre').html("5-10个汉字");
             return false;
         }
     }

     //验收
     function check(){
         if(check_addre() && check_phone()){
              return true;
         }else{
             return false;
         }
     }
 </script>


  <div class="footer">
  <div class="gezifooter">
      
      <a href="Login" class="ui-link">立即登陆</a> <font color="#878787">|</font> 
       <a href="Register" class="ui-link">免费注册</a> <font color="#878787">|</font>                 
                  

       <a href="../www.gridinn.com/@display=pc" class="ui-link">电脑版</a>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
  </div>
  </div>

</body>
</html>


<script src="{{ URL::asset('/') }}js/area.js"></script>
<script src="{{ URL::asset('/') }}js/jq.js"></script>
<script>

    var obj = eval(json);
    //alert(obj.province[2]);
    var str="<option>请选择</option>";
    for(var i in obj.province){
        str+= '<option value="'+i+'">'+obj.province[i]+'</option>';
    }
    //alert(str);
    $("#province").html(str);
    $("#county").html("<option>请选择</option>");


    function pro_change(pro){
        var id = $(pro).val();
        //alert(id);
        var str="<option>请选择</option>";
        for(var i in obj.city[id]){
            str+= '<option value="'+i+'">'+obj.city[id][i]+'</option>';
        }
        //alert(str);
        $("#city").html(str);
    }

    function city_change(pro){
        var id = $(city).val();
        //alert(id);
        var str="<option>请选择</option>";
        for(var i in obj.county[id]){
            str+= '<option value="'+i+'">'+obj.county[id][i]+'</option>';
        }
        //alert(str);
        $("#county").html(str);
    }



</script>

