<!DOCTYPE html>
<html lang="en">
	<head>
		<style>
			#bg{background-color: #ccc;width: 546px;/*  margin-left: 200px */}
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
						     $("#bg span").click(function(i){
								 //标记出当前选中的选项卡
								 $("#bg span").css("background","#ccc");
								 $(this).css("background","#00f");
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
								<span style="background:#00f" id='menu_a0'>通用信息</span>
								<span id='menu_a1'>详细描述</span>
								<span id='menu_a2'>坐标位置</span>
							</div>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12" id="table">
								
										<!-- PAGE CONTENT BEGINS -->
                            <form class="form-horizontal" role="form" action="HotelEdit" method="post" enctype="multipart/form-data">
                            	<table id="tab_a0" width="800px">
                            	<th width="800px">
                            		<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">酒店名称</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="h_name" placeholder="" class="col-xs-10 col-sm-5" value="{{$data['data']->h_name}}"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">酒店备注</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="" name="h_beizhu" class="col-xs-10 col-sm-5" value="{{$data['data']->h_beizhu}}"/>
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
											<select name="h_type">
												<option value="商务型酒店"
												<?php 
													if ($data['data']->h_type == '商务型酒店') {
														echo "selected";
													}
												?>
												>商务型酒店</option>
												<option value="度假型酒店"
												<?php 
													if ($data['data']->h_type == '度假型酒店') {
														echo "selected";
													}
												?>				
												>度假型酒店</option>
												<option value="长住型酒店"
												<?php 
													if ($data['data']->h_type == '长住型酒店') {
														echo "selected";
													}
												?>
												>长住型酒店</option>
												<option value="会议型酒店"
												<?php 
													if ($data['data']->h_type == '长住型酒店') {
														echo "selected";
													}
												?>
												>会议型酒店</option>
												<option value="观光型酒店"
												<?php 
													if ($data['data']->h_type == '观光型酒店') {
														echo "selected";
													}
												?>
												>观光型酒店</option>
												<option value="经济型酒店"
												<?php 
													if ($data['data']->h_type == '经济型酒店') {
														echo "selected";
													}
												?>
												>经济型酒店</option>
												<option value="连锁酒店"
												<?php 
													if ($data['data']->h_type == '连锁酒店') {
														echo "selected";
													}
												?>
												>连锁酒店</option>
												<option value="公寓式酒店"
												<?php 
													if ($data['data']->h_type == '公寓式酒店') {
														echo "selected";
													}
												?>
												>公寓式酒店</option>
											</select>
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
												@foreach ($data['sheng'] as $v) 
													@if ($v->region_id == $data['pro'])
													<option value="{{$v->region_id}}" selected="selected">{{$v->region_name}}</option>
													@else
													<option value="{{$v->region_id}}">{{$v->region_name}}</option>	
													@endif
												@endforeach
											</select>
											市:<select name="shi" id="city" onchange="citys(this)">
												<option value="">--请选择--</option>
												@foreach ($data['shi'] as $v) 
													@if ($v->region_id == $data['ci'])
													<option value="{{$v->region_id}}" selected="selected">{{$v->region_name}}</option>
													@else
													<option value="{{$v->region_id}}">{{$v->region_name}}</option>	
													@endif
												@endforeach
											</select>
											县:<select name="xian" id="area">
												<option value="">--请选择--</option>
												@foreach ($data['xian'] as $v) 
													@if ($v->region_id == $data['cou'])
													<option value="{{$v->region_id}}" selected="selected">{{$v->region_name}}</option>
													@else
													<option value="{{$v->region_id}}">{{$v->region_name}}</option>	
													@endif
												@endforeach
											</select>
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">详细地址</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="" name="h_address" class="col-xs-10 col-sm-5" value="{{$data['data']->h_address}}"/>
										</div>
									</div>
									<script src="/js/area.js"></script>
									<script>
										var json = eval(json);
										/*var pro = $('#pro').val();
										//alert(pro);
										var selected = 'selected';
										var str = '<option value="">--请选择--</option>';
										for(i in json.province){
											str += '<option value="'+i+'" >'+json.province[i]+'</option>';
										}
										$("#province").html(str);
*/
										function provinces(p_id){
											var p_id = $(p_id).val();
											var st = '<option value="">--请选择--</option>';
												for( a in json.city[p_id]){
													st += '<option value="'+a+'" >'+json.city[p_id][a]+'</option>';
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
											<input type="text" id="form-field-2" class="col-xs-10 col-sm-5" name="h_tel" value="{{$data['data']->h_tel}}"/>
										</div>
									</div>

									<div class="space-4"></div>
									<div class="form-group">
								     <div class="col-sm-9">
											<input type="hidden" class="form-control" name="_token" value="<?php echo csrf_token(); ?>" />
									 	<input type="hidden" name="h_id" value="{{$data['data']->h_id}}">
									 </div>
									</div>
									</th>
                            	</table>
                            	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
								<table id="tab_a1" style="display:none;"><th width="800px">
									<textarea name="h_desc" id="TextArea1" cols="20" rows="2" class="ckeditor">{{$data['data']->h_desc}}</textarea>
								</th></table>
								<table id="tab_a2" style="display:none;"><th width="800px">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">X坐标</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="" name="h_x" class="col-xs-10 col-sm-5" value="{{$data['data']->h_x}}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">Y坐标</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="" name="h_y" class="col-xs-10 col-sm-5" value="{{$data['data']->h_y}}"/>
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
