					<ul class="nav nav-list">

						<li class="active">
							<a href="admin" target="_top">
								<i class="icon-dashboard"></i>
								<span class="menu-text">管理列表</span>
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
                       
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>