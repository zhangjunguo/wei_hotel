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

					<div class="page-content">
						<div class="page-header">
							<h1>
								户型信息列表
							</h1>
							<!-- <input type="text" id="keyword" placeholder="酒店名称" class="nav-search-input"  autocomplete="off" />
							酒店类型：<select name="h_type" id="h_type"> 
								<option value="">请选择...</option>
								<option value="商务型酒店">商务型酒店</option>
								<option value="度假型酒店">度假型酒店</option>
								<option value="长住型酒店">长住型酒店</option>
								<option value="会议型酒店">会议型酒店</option>
								<option value="观光型酒店">观光型酒店</option>
								<option value="经济型酒店">经济型酒店</option>
								<option value="连锁酒店">连锁酒店</option>
								<option value="公寓式酒店">公寓式酒店</option>
							</select> -->
							<button class="btn btn-xs btn-info" id="but" style="float:right;">返回酒店列表</button>

							<button class="btn btn-xs btn-danger" id="button" style="float:right;">添加户型</button>
							<input type="hidden" id="hid" value="{{$data['h_id']}}">
						</div><!-- /.page-header -->
						<div class="row">
									<div class="col-xs-12">
										<div class="table-responsive" id="div">

											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">编号</th>
														<th>户型名称</th>
														<th>普通价格</th>
														<th>会员价格</th>
														<th>促销价格</th>
														<th>户型总数</th>
														<th>户型图</th>
														<th>操作</th>
													</tr>
												</thead>
                                            	@foreach($data['data'] as $k => $v)
												<tbody>
													<tr>
														<td class="center" id="h_id">{{$v->r_id}}</td>
                                                        <td class="input" id="{{$v->h_id}}">{{$v->r_name}}</td>
														<td>¥<font>{{$v->r_price}}</font></td>
														<td>¥<font color="red">{{$v->r_vip_price}}</font></td>
														<td>¥<font color="red">{{$v->r_pro_price}}</font></td>
														<td>
														{{$v->r_num}}
														</td>
														<td><img src="uploads/room/{{$v->r_img}}" alt="" width="150px" height="100px"></td>
														<td>
														   <button class="btn btn-xs btn-info" title="编辑" onclick="edit({{$v->r_id}})">
																<i class="icon-edit bigger-120"></i>
															</button>

															<button class="btn btn-xs btn-danger" title="删除" onclick="del({{$v->r_id}},<?php echo $data['data']->currentPage();?>)">
																<i class="icon-trash bigger-120"></i>
															</button>
                                                        </td>
                                                        </tr>
													</tbody>
													 @endforeach
											       </table>
											       <?php echo $data['data']->render(); ?>

										        </div><!-- /.table-responsive -->
									   </div><!-- /span -->
								 </div><!-- /row -->
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
		var h_id = $('#hid').val();
		window.location.href="RoomAdd?h_id="+h_id;
	})

	$('#but').click(function(){
		window.location.href="HotelShow";
	})

	function edit(r_id) {
		//alert(h_id);
		
		window.location.href="RoomEdit?r_id="+r_id;
	}

	function del(r_id,page) {
		if (page == '') {
			page = 1;
		}
		var h_id = $('#hid').val();
		if(window.confirm('您确定要删除吗')){
			window.location.href="RoomDel?r_id="+r_id+'&&page='+page+'&&h_id='+h_id;
		}		
	}

	

	/*$('.input').click(function(){
		var zhi = $(this).html();
		var id = $(this).attr('id');
		//alert(id);
		var input = $("<input type='text' />");
		//alert(input);
		$(this).html(input);
		$(input).val(zhi);
		$(input).click(function(){
			return false;
		})
		$(input).blur(function(){
			var that = $(this);
			var new_zhi = that.val();
			//alert(new_zhi);
			$.get('HotelQup',{'h_name':new_zhi,'h_id':id},function(msg){
				//if (msg=='1') {
					//window.location.reload();
					that.parent().text(new_zhi);
				//}
			})
		})
	})*/
</script>