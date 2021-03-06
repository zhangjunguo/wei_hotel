<!DOCTYPE html>
<html lang="en">
	<head>
		<style>
			body,ul,li{margin: 0;padding: 0;font: 12px normal "宋体", Arial, Helvetica, sans-serif;list-style: none;}
			a{text-decoration: none;color: #000;font-size: 14px;}

			#tabbox{ width:600px; overflow:hidden; margin:0 auto;}
			.tab_conbox{border: 1px solid #999;border-top: none;}
			.tab_con{ display:none;}

			.tabs{height: 32px;border-bottom:1px solid #999;border-left: 1px solid #999;width: 100%;}
			.tabs li{height:31px;line-height:31px;float:left;border:1px solid #999;border-left:none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
			.tabs li a {display: block;padding: 0 20px;border: 1px solid #fff;outline: none;text-decoration: none}
			.tabs li a:hover {background: #ccc;}    
			.tabs .thistab,.tabs .thistab a:hover{background: #fff;border-bottom: 1px solid #fff;}

			.tab_con {padding:12px;font-size: 14px; line-height:175%;}
		</style>
		<meta charset="utf-8" />
		<title>首页后台管理系统</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="js/admin/fonts.googleapis.js" />

		<!-- ace styles -->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<script>
        setInterval('fun()',1000);
    function fun(){
        var date = new Date();
        var date1 = date.toLocaleString();
        //alert(date1);
        document.getElementById('time').innerHTML = date1;  
        } 

    </script>
	</head>

	<body>
		@include('admin/header')
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>
                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					<!-- </div> --><!-- #sidebar-shortcuts -->

@include('admin/left')

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">管理中心</a>
							</li>

							<li>
								<a href="#">酒店管理</a>
							</li>
							<li class="active">管理信息列表</li>
						</ul><!-- .breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- #nav-search -->
					</div>
					<script src="/js/admin/jquery1.js"></script>
					<script>
						 $(function(){
						     $("#bg a").click(function(i){
								 //标记出当前选中的选项卡
								 $("#bg a").css("background","#e0e0e0");
								 $(this).css("background","#fff");
					             //下面的div显示隐藏控制
								 var divid=$(this).attr("id").replace("menu_","tab_");
								 $("#table table").css("display","none");
								 //$("#"+divid).css("width", "100%");
								 $("#"+divid).css({"display":"block"});
							 });
						   });
					</script>
					<div class="page-content">
						<div class="page-header">
							<div id="bg">
								<ul class="tabs" id="tabs">
									<li style="background-color:#fff"><a href="javascript:void(0)" id='menu_a0'>通用信息</a></li>
									<li><a href="javascript:void(0)" id='menu_a1'>详细描述</a></li>
									<li><a href="javascript:void(0)" id='menu_a2'>坐标位置</a></li>
								</ul>
							</div>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12" id="table">
								
										<!-- PAGE CONTENT BEGINS -->
                            <form class="form-horizontal" role="form" action="HotelAdd" method="post" enctype="multipart/form-data" onsubmit="return sub()">
                            	<table id="tab_a0" width="800px">
                            	<th width="800px">
                            		<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">酒店名称</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="h_name" placeholder="" class="col-xs-10 col-sm-5" onblur="fun1()"/>
											<span id="sp1"></span>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">酒店备注</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="" name="h_beizhu" class="col-xs-10 col-sm-5" onblur="fun2()" />
											<span id="sp2"></span>
										</div>
									</div>

									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-3">酒店图</label>

										<div class="col-sm-9">
											<input type="file" id="form-field-3" name="h_img" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-4">酒店类型</label>

										<div class="col-sm-9">
											<div class="control-group">
										<div class="controls">
											<select name="h_type" onchange="citys()">
												<option value="…请选择…">…请选择…</option>
												<option value="商务型酒店">商务型酒店</option>
												<option value="度假型酒店">度假型酒店</option>
												<option value="长住型酒店">长住型酒店</option>
												<option value="会议型酒店">会议型酒店</option>
												<option value="观光型酒店">观光型酒店</option>
												<option value="经济型酒店">经济型酒店</option>
												<option value="连锁酒店">连锁酒店</option>
												<option value="公寓式酒店">公寓式酒店</option>
											</select>
											<span id="sp7"></span>
										</div>
											</div>
										</div>
									</div>
									
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">酒店地址</label>

										<div class="col-sm-9">
											省:<select name="sheng" id="province" onchange="provinces(this)">
												<option value="">--请选择--</option>
											</select>
											市:<select name="shi" id="city" onchange="citys(this)">
												<option value="">--请选择--</option>
											</select>
											县:<select name="xian" id="area">
												<option value="">--请选择--</option>
											</select>
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">详细地址</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="" name="h_address" class="col-xs-10 col-sm-5" onblur="fun3()" />
											<span id="sp3"></span>
										</div>
									</div>
									<script src="/js/area.js"></script>
									<script>
										var json = eval(json);
										var str = '<option value="">--请选择--</option>';
										for(i in json.province){
											str += '<option value="'+i+'">'+json.province[i]+'</option>';
										}
										$("#province").html(str);

										function provinces(p_id){
											var p_id = $(p_id).val();
											var st = '<option value="">--请选择--</option>';
												for( a in json.city[p_id]){
													st += '<option value="'+a+'">'+json.city[p_id][a]+'</option>';
												}
											$("#city").html(st);
											$("#area").html('<option value="">--请选择--</option>');
										}
										
										function citys(c_id){
											var c_id = $(c_id).val();
											var sr = '<option value="">--请选择--</option>';
												for( a in json.county[c_id]){
													sr += '<option value="'+a+'">'+json.county[c_id][a]+'</option>';
												}
											$("#area").html(sr);
										}
									</script>
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">酒店电话</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" class="col-xs-10 col-sm-5" name="h_tel" onblur="fun4()" />
											<span id="sp4"></span>
										</div>
									</div>

									<div class="space-4"></div>
									<div class="form-group">
								     <div class="col-sm-9">
											<input type="hidden" class="form-control" name="_token" value="<?php echo csrf_token(); ?>" />
									 </div>
									</div>
									</th>
                            	</table>
                            	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
								<table id="tab_a1" style="display:none;"><th width="800px">
									<textarea name="h_desc" id="TextArea1" cols="20" rows="2" class="ckeditor" onkeyup="dis()"></textarea><span id="sp11"></span>
								</th></table>
								<table id="tab_a2" style="display:none;"><th width="800px">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">X坐标</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="" name="h_x" class="col-xs-10 col-sm-5" onblur="fun5()" />
											<span id="sp5"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">Y坐标</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="" name="h_y" class="col-xs-10 col-sm-5" onblur="fun6()" />
											<span id="sp6"></span>
										</div>
									</div>
								</th></table>
									

							
                                    <div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i>
												提交
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="icon-undo bigger-110"></i>
												重置
											</button>
										</div>
									</div>
								</form>
               				</div>
								
								
				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-skin="default" value="#438EB9">#438EB9</option>
									<option data-skin="skin-1" value="#222A2D">#222A2D</option>
									<option data-skin="skin-2" value="#C6487E">#C6487E</option>
									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; 选择皮肤</span>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
							<label class="lbl" for="ace-settings-navbar">固定头部</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar">修复侧边拦建立问题</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs">固定面包屑导航</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> 右到左(rtl)</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
							<label class="lbl" for="ace-settings-add-container">
								内部
								<b>.container</b>
							</label>
						</div>
					</div>
				</div><!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div>
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="js/admin/jquery1.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="js/admin/jquery1.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
	<div style="display:none"><script src='js/admin/v7.cnzz.js' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>

<script>
	function fun1()
	{
		var hname = document.getElementsByName('h_name')[0].value;
		var sp = document.getElementById('sp1');
		if(hname == ''){
			sp.style.color = 'red';
			sp.innerHTML = '不能为空';
			return false;
		}else{
			return true;
		}
	}

	function fun2()
	{
		var hbeizhu = document.getElementsByName('h_beizhu')[0].value;
		var sp = document.getElementById('sp2');
		if(hbeizhu == ''){
			sp.style.color = 'red';
			sp.innerHTML = '不能为空';
			return false;
		}else{
			return true;
		}
	}

	function fun3()
	{
		var hname = document.getElementsByName('h_address')[0].value;
		var sp = document.getElementById('sp3');
		if(hname == ''){
			sp.style.color = 'red';
			sp.innerHTML = '不能为空';
			return false;
		}else{
			return true;
		}
	}

	function fun4()
	{
		var htel = document.getElementsByName('h_tel')[0].value;
		var sp = document.getElementById('sp4');
		if(htel == ''){
			sp.style.color = 'red';
			sp.innerHTML = '不能为空';
			return false;
		}else{
			var reg = /^(1[34578]\d{9})|(\d{3}(\-)\d{8})$/;
			if(reg.test(htel)){
				return true;
			}else{
				sp.style.color = 'red';
				sp.innerHTML = '格式不正确';
				return false;
			}
		}
	}

	function citys()
	{
		var ucity = document.getElementsByName('h_type')[0].value;
		var sp7 = document.getElementById('sp7');
		if(ucity == '…请选择…'){
			sp7.innerHTML = "必须选择一项";
			sp7.style.color= 'red';
			return false;
		}else{
			return true;
		}
	}

		function dis()
		{
			var text = document.getElementById('TextArea1').value;
			//alert(text);
			var sp11 = document.getElementById('sp11');
			if(text == ''){
				sp11.innerHTML = "不能为空";
				sp11.style.color='red';
				return false;
			}else{
				var reg = /^[\u4e00-\u9fa5\w]{0,300}$/;
				var descscut = text.substr(0,300);
				if (!reg.test(text)) {					
					document.getElementById('text').value = descscut;
					sp11.innerHTML = "不能超过300字";
					sp11.style.color='red';
					return false;
				}else{
					var descslen = text.length;
					var descslast = 300 - descslen;
					sp11.innerHTML = "还剩"+descslast+"字";
					sp11.style.color='red';
					return true;
				}
			}
			
		}

	function fun5()
	{
		var hname = document.getElementsByName('h_x')[0].value;
		var sp = document.getElementById('sp5');
		if(hname == ''){
			sp.style.color = 'red';
			sp.innerHTML = '不能为空';
			return false;
		}else{
			return true;
		}
	}

	function fun6()
	{
		var hname = document.getElementsByName('h_y')[0].value;
		var sp = document.getElementById('sp6');
		if(hname == ''){
			sp.style.color = 'red';
			sp.innerHTML = '不能为空';
			return false;
		}else{
			return true;
		}
	}

	function sub()
	{
		if(fun1()&fun2()&fun3()&fun4()&fun5()&fun6()&citys()){
			return true;
		}else{
			return false;
		}
	}
</script>
