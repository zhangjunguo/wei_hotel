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
								<a href="#">订单管理</a>
							</li>
							<li class="active">订单管理列表</li>
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
								订单管理列表
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
									<div class="col-xs-12">
										<div class="table-responsive">
<input type="text" placeholder="订单号" id="o_num">
<input type="text" placeholder="入住时间" id="od_start_time">
<input type="text" placeholder="离店时间" id="od_end_time">
<select id="o_state">
	<option value="">---请选择---</option>
	<option value="1">未付款</option>
	<option value="2">已付款，未消费</option>
	<option value="3">已付款，已消费</option>
	<option value="4">交易取消</option>
</select>
<button id="search" class="btn btn-purple btn-sm" style="height:33px;" onclick="page(1)">搜索<i class="icon-search icon-on-right bigger-110"></i></button>
										<div id="div1">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">编号</th>
														<th>订单号</th>
														<th>下单时间</th>
														<th>收货人</th>
														<!-- <th>总金额</th> -->
														<th>应付金额</th>
														<th>订单状态</th>
														<th>操作</th>
													</tr>
												</thead>
												<tbody id="tbody">
												@foreach($arr as $k => $v)
													<tr>
														<td class="center">{{$v->o_id}}</td>
                                                        <td><span onmouseover="block(this)" class="move">{{$v->o_num}}</span></td>
                                                        <!-- <td></td> -->
                                                        <td>{{date('Y-m-d',$v->o_addtime)}}</td>
                                                        <td>{{$v->user_name}}</td>
                                                        <td><span onclick="change(this)">{{$v->o_price}}</span>
				<input type="text" name="price" value="{{$v->o_price}}" id="{{$v->o_id}}" style="display:none;" onblur="update(this)">
                                                        </td>
                                                        <td>
                                                        	<?php if($v->o_state == 1){ ?>
                                                        		未付款
                                                        	<?php }elseif($v->o_state == 2){ ?>
                                                        		已付款，未消费
                                                        	<?php }elseif($v->o_state == 3){ ?>
                                                        		已付款，已消费
                                                        	<?php }elseif($v->o_state == 4){ ?>
																交易取消
                                                        	<?php } ?>
                                                        </td>
														<td>
															<!--    <button class="btn btn-xs btn-info">
																	<i class="icon-edit bigger-120"></i>
																</button> -->
														   <button class="btn btn-xs btn-info" onclick="xiang({{$v->o_id}})">
																	<i class="icon-edit bigger-120"></i>
																</button>
																<button class="btn btn-xs btn-danger" onclick="orderDel({{$v->o_id}})">
																	<i class="icon-trash bigger-120"></i>
																</button>
                                                        </td>
                                                        </tr>
                                                @endforeach       
													</tbody>
											       </table>
											       <a href="javascript:page(1)">首页</a>
											       <a href="javascript:page({{$last}})">上一页</a>
											       <a href="javascript:page({{$next}})">下一页</a>
											       <a href="javascript:page({{$page_count}})">尾页</a>
											      </div>
										        </div><!-- /.table-responsive -->
									   </div><!-- /span -->
								 </div><!-- /row -->
               </div>
											       <!-- 详情 -->
<div id="div2" style="position:absolute; background:#cccccc"></div>

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

		<script src="http://www.zhang.com/assets/js/jquery-2.0.3.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://www.zhang.com/assets/js/jquery-2.0.3.min.js"></script>
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
<script src="js/admin/jquery1.js"></script>
</body>
</html>
<script>
// 删除订单
	function orderDel(id){
		// alert(id);
		$.get("OrderDel",{'o_id':id},function(e){
			if(e == 1){
				alert('交易未完成不能删除');
			}else{
				location.href='OrderList';
				// $("#div1").html(e);
			}
		});
	}
// 修改订单金额
	function change(span){
		$(span).css('display','none');
		$(span).next().css('display','block');
	}
	function update(input){
		var price = $(input).val();
		var id = $(input).attr('id');
		$.get('OrderUpdate',{'price':price,"id":id},function(e){
			if(e){
				$(input).prev().html(price);
				$(input).css('display','none');
				$(input).prev().css('display','block');
				$("#tbody").html(e);
			}
		});
	}

// 搜索订单

		function page(page){
			var o_num = $("#o_num").val();
			var od_start_time = $("#od_start_time").val();
			var od_end_time = $("#od_end_time").val();
			var o_state = $("#o_state").val();
			// alert(o_state);
			$.get("OrderSearch",{"o_num":o_num,"od_start_time":od_start_time,"od_end_time":od_end_time,"o_state":o_state,'page':page},function(e){
				// console.log(e);
				$("#div1").html(e);
			});
		}
// 查看订单详情
	function xiang(o_id){
		location.href='OrderXiang?o_id='+o_id;
	}
	// 鼠标移上显示
$(".move").mousemove(function (e) { 
    var x; 
    var y; 
    var xy="<br>x坐标:"+e.pageX+"，y坐标："+e.pageY; 
    x=e.pageX; 
    y=e.pageY; 
    document .getElementById("div2").style.left = x + "px"; 
    document .getElementById("div2").style.top = y + "px"; 
     $("#div2").show('slow'); 
    // $("#div2").html(xy); 
})  
// 鼠标移出div隐藏
$(".move").mouseout(function () { 
    $("#div2").hide('slow'); 
})  
// 显示详细信息
	function block(span){
		// alert(1);
		var o_num = $(span).html();
		// alert(o_num);
		var str = "";
				str+="<table width=700  class='table table-striped table-bordered table-hover'>";
					str+="<tr>";
						str+="<th>编号</th>";
						str+="<th>姓名</th>";
						str+="<th>酒店</th>";
						str+="<th>房型</th>";
						str+="<th>数量</th>";
						str+="<th>金额</th>";
						str+="<th>入住时间</th>";
						str+="<th>离开时间</th>";
					str+="</tr>";
		$.get("OrderXiangqing",{"o_num":o_num},function(e){
			// alert(e);
			for(i in e){
				// alert(e[i].user_name)
				str+="<tr>";
						str+="<th>"+e[i].o_id+"</th>";
						str+="<th>"+e[i].user_name+"</th>";
						str+="<th>"+e[i].h_name+"</th>";
						str+="<th>"+e[i].r_name+"</th>";
						str+="<th>"+e[i].od_count+"</th>";
						str+="<th>"+e[i].od_xiaoji+"</th>";
						str+="<th>"+e[i].od_start_time+"</th>";
						str+="<th>"+e[i].od_end_time+"</th>";
				str+="</tr>";
			}
			str+="</table>";
			$("#div2").html(str);
		},'json');
	}
</script>
