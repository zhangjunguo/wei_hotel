<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>订单评价</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <link href="../home/css/bootstrap.min.css" rel="stylesheet" />
        <link  rel="stylesheet" href="../home/css/main.css" />
        <link rel="stylesheet" type="text/css" href="../home/css/sinaFaceAndEffec.css" />
        <link href="../home/css/NewGlobal.css" rel="stylesheet" />
        <script type="text/javascript" src="../home/js/zepto.js"></script>
        <style>
         .content{width:100%}
         .fen{line-height: 25px;line-height:25px;font-size:18px;color:green;}
         .emoji2{color:#e4664f;height:25px;line-height:25px;float:right}
        </style>
    </head>
    
    <body id="div" >
        <div class="header" id="content" >
            <a href="/" class="home">
                <span class="header-icon header-icon-home"></span>
                <span class="header-name">主页</span></a>
            <div class="title" id="titleString">评论</div>
            <a href="javascript:history.go(-1);" class="back">
                <span class="header-icon header-icon-return"></span>
                <span class="header-name">返回</span></a>
        </div>
        <div class="container width80 pt20">
            <div class="control-group">
             	<small class="fen">
             	<img src="../uploads/{{$results->h_img}}" alt="{{$results->h_name}}" width="50px" height="50px" />
             	酒店评分:<span id="element2" class="emoji2"></span>
             	</small>
            </div>
           <div class="content">
				<div class="cont-box">
					<textarea class="text" placeholder="请输入..." cols="10" rows="0">
					</textarea>
				</div>
				<div class="tools-box">
					<div class="operator-box-btn">
					<span class="face-icon">☺</span>
					<span class="img-icon">▧</span>
					</div>
					<div class="submit-btn">
					<input type="button" id="butt" value="提交评论" />
					</div>
				</div>
			</div>
        </div>
<div class="footer">
  <div class="gezifooter">
  <?php if(Session::get('user_name')){ ?>
  <font color="#878787">|</font> <a href="loginout" title="退出" >退出</a>
  <?php }else{ ?>
      <a href="Login" class="ui-link">立即登陆</a> <font color="#878787">|</font> 
       <a href="Register" class="ui-link">免费注册</a> <font color="#878787">|</font>   
   <?php } ?>
                  
      <a href="../../www.gridinn.com/@display=pc" class="ui-link">电脑版</a>
  </div>
  <div class="gezifooter">
    <p style="color:#bbb;">格子微酒店连锁 &copy; 版权所有 2012-2014</p>
  </div>
 </div>
</body>
</html>
    <script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/sinaFaceAndEffec.js"></script>
	<script>window.jQuery || document.write('<script src="js/jq.js"><\/script>')</script>
	<script src="../home/src/jquery.emojiRatings.js"></script>
	<script>
		$(function(){
			$("#element2").emojiRating({
				emoji: 'U+2764',
				fontSize: 25,
			    	count: 5
			});
		});
		// 绑定表情
	    $('.face-icon').SinaEmotion($('.text'));
	   // 测试本地解析
	   function out() {
		  var inputText = $('.text').val();
		  $('#info-show ul').append(reply(AnalyticEmotion(inputText)));
	   }
	    $("#butt").click(function(){
	       // var h_id=$("#h_id").val();
	       // alert(h_id);
           var star= $(".emoji-rating").val();
           var content=$(".text").val();
          $.get("commentok",{star:star,content:content}, function(){
          	   alert('评论成功');
               location.href="/";
          });
	   })
	</script>