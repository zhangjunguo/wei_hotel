
					<ul class="nav nav-list">


						<!-- <li class="active"> -->

						<li class="active1">


							<a href="admin" target="_top">
								<i class="icon-dashboard"></i>
								<span class="menu-text" >管理列表</span>
							</a>
						</li>  
					
                        <li>	
                        @foreach($data as $v)
                           <a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text">{{$v->p_name}}</span>

								<b class="arrow icon-angle-down"></b>
							</a>
							@foreach($v->data as $data_val)
                            <ul class="submenu"  >
                              	@foreach($v->data as $data_val)
                               <li>
									<a href="{{$data_val->p_routes}}" target="_top">
										<i class="icon-double-angle-right"></i>
										{{$data_val->p_name}}
									</a>
								</li>
								@endforeach
							</ul>
							@endforeach
						@endforeach
						</li>

						<!-- 地区管理////////end -->


						<!-- 订单管理////////start -->
						<!-- 	<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text">订单管理</span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="OrderList" target="_top">
										<i class="icon-double-angle-right"></i>
										订单列表
									</a>
								</li>
							</ul>
						</li> -->


					
					
					<!-- 文章管理 start -->
					<!-- 	<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text">文章管理</span>

								<b class="arrow icon-angle-down"></b>
							</a> -->
							<!-- 子类 -->
							<!-- <ul class="submenu">
								<li>
									<a href="articlelist" target="_top">
										<i class="icon-double-angle-right"></i>
										文章列表
									</a>
								</li>

								<li>
									<a href="articleadd">
										<i class="icon-double-angle-right"></i>
										文章添加

									</a>
								</li>
							</ul>
						</li> -->

						
					<!-- 酒店管理 start -->
					<!-- 	<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text">酒店管理</span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="HotelShow" target="_top">
										<i class="icon-double-angle-right"></i>
										酒店列表
									</a>
								</li>
								<li>

									<a href="HotelAdd">
										<i class="icon-double-angle-right"></i>
										酒店添加
									</a>
								</li>
							</ul>
						</li>	 -->
						<!-- 文章管理 end -->
					

					<!-- 活动管理 start -->
					<!-- 	<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text">活动管理</span>

								<b class="arrow icon-angle-down"></b>
							</a> -->
							<!-- 子类 -->
							<!-- <ul class="submenu">
								<li>
									<a href="activitylist" target="_top">
										<i class="icon-double-angle-right"></i>
										活动列表
									</a>
								</li>
								<li>
									<a href="activityadd">
										<i class="icon-double-angle-right"></i>
										活动添加
									</a>
								</li>
							</ul>
						</li>
						 -->


					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>




<script src="js/admin/jquery1.js"></script>
<script>
// alert(1);
var pathname = window.location.pathname;
// alert(pathname);
pathname = pathname.substr(1);
// alert(pathname);
$("li a").each(function() {

var href = $(this).attr("href");
// alert(href);
if(pathname == href){

$(this).parent().parent().parent().addClass("active");

$(this).parent().addClass("active");

}

});

</script>