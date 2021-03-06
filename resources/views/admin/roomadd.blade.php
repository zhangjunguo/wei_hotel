<!DOCTYPE html>
<html lang="en">
	<head>
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
							<li class="active">户型信息列表</li>
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

					<div class="page-content">
						<div class="page-header">
							<h1>
								户型信息添加
							</h1>
							<button class="btn btn-xs btn-danger" id="button" style="float:right;">返回列表</button>
							
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                            <form class="form-horizontal" role="form" action="RoomAdd" method="post" enctype="multipart/form-data" onsubmit="return sub()">
                            <input type="hidden" name="h_id" id="hid" value="{{$h_id}}">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">户型名称</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="r_name" placeholder="户型名称" class="col-xs-10 col-sm-5" onblur="fun1()" />
											<span id="sp1"></span>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">普通价格</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="普通价格" name="r_price" class="col-xs-10 col-sm-5" onblur="fun2()" />
											<span id="sp2"></span>
										</div>
									</div>

									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-3">会员价格</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-3" placeholder="会员价格" name="r_vip_price" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-4">促销价格</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-4" placeholder="促销价格" name="r_pro_price" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="space-4"></div>
									<div class="form-group">
								     <div class="col-sm-9">
											<input type="hidden" class="form-control" name="_token" value="<?php echo csrf_token(); ?>" />
									 </div>
									</div>

									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-4">户型数量</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-4" placeholder="户型数量" name="r_num" class="col-xs-10 col-sm-5" onblur="fun3()" />
											<span id="sp3"></span>
										</div>
									</div>
									
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-4">户型图</label>

										<div class="col-sm-9">
											<input type="file" id="form-field-4" placeholder="" name="r_img" class="col-xs-10 col-sm-5" />
										</div>
									</div>

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
	$('#button').click(function(){
		var h_id = $('#h_id').val();
		window.location.href='RoomShow?h_id='+h_id;
	})

	function fun1()
	{
		var r_name = document.getElementsByName('r_name')[0].value;
		var sp = document.getElementById('sp1');
		if(r_name == ''){
			sp.style.color = 'red';
			sp.innerHTML = '不能为空';
			return false;
		}else{
			return true;
		}
	}

	function fun2()
	{
		var r_price = document.getElementsByName('r_price')[0].value;
		var sp = document.getElementById('sp2');
		if(r_price == ''){
			sp.style.color = 'red';
			sp.innerHTML = '不能为空';
			return false;
		}else{
			return true;
		}
	}

	function fun3()
	{
		var r_num = document.getElementsByName('r_num')[0].value;
		var sp = document.getElementById('sp3');
		if(r_num == ''){
			sp.style.color = 'red';
			sp.innerHTML = '不能为空';
			return false;
		}else{
			var reg = /^\d+$/;
			if(reg.test(r_num)){
				return true;
			}else{
				sp.style.color = 'red';
				sp.innerHTML = '必须为数字';
				return false;
			}
		}
	}

	function sub()
	{
		if(fun1()&fun2()&fun3()){
			return true;
		}else{
			return false;
		}
	}	
</script>