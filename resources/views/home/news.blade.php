<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>礼品正文</title>
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
<div class="title" id="titleString">{{$data->act_name}}</div>
<a href="javascript:history.go(-1);" class="back">
            <span class="header-icon header-icon-return"></span>
            <span class="header-name">返回</span>
        </a>
 </div>

        
    <div class="container width90">
        <p class="newstitle">{{$data->act_name}}</p>
        <div style="font-size:11pt">{{$data->act_desc}}</div>

    </div>

  <center><button class="submit-button" style="width: 60%; height: 45px; background: #6ac134; color: #fff; border: 1px solid #6ac134" />参加活动</button></center>
  <div class="footer">
  <div class="gezifooter">
      
             <?php if(Session::get('user_name')){ ?>
  <font color="#878787">|</font> <a href="loginout" title="退出" >退出</a>
  <?php }else{ ?>
      <a href="Login" class="ui-link">立即登陆</a> <font color="#878787">|</font> 
       <a href="Register" class="ui-link">免费注册</a> <font color="#878787">|</font>   
   <?php } ?>            
      <input type="hidden" id="act_id" value="{{$data->act_id}}" />            
      <input type="hidden" id="u_id" value="<?php echo Session::get('user_id')?>" />
       <a href="../www.gridinn.com/@display=pc" class="ui-link">电脑版</a>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
  </div>
  </div>

</body>
</html>
<script src="/jq.js"></script>
<script>
    $('.submit-button').click(function(){
      var uid = $('#u_id').val();
      //alert(uid);
      if(uid == ''){
        alert('请先登录');
      }else{
        var actid = $('#act_id').val();
        $.get('JoinAct', {'u_id':uid, 'act_id':actid}, function(msg){
          if(msg == '1'){
            alert('您已经参与过此活动了,请不要重复参与哦!');
            //window.location.reload();
          }else{
            alert('参与成功');
          }
        })
      }
    })
</script>