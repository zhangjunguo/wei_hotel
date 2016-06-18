<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">

				<table id="sample-table-1" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="center">编号</th>
							<th>活动名称</th>
							<th>开始时间</th>
							<th>结束时间</th>
							<th>图片</th>
							<th>描述</th>
							<th>操作</th>
						</tr>
					</thead>
                @foreach($data['data'] as $v)
					<tbody>
						<tr>
							<td class="center">{{$v->act_id}}</td>

			<!-- 文章标题的即点即改 -->

                            <td onclick="fun1({{$v->act_id}})">

                      <input type="text" value="{{$v->act_name}}" id="i{{$v->act_id}}" onblur="fun2({{$v->act_id}})" style="display:none"  /> 
                       <span id="s{{$v->act_id}}">{{$v->act_name}}</span>

                            </td>

				<!-- 结束 -->

							<td>{{ date('Y-m-d H:i:s',$v->act_start_time)}}</td>
							<td>{{ date('Y-m-d H:i:s',$v->act_end_time)}}</td>
							<td><img src="{{$v->act_img}}" alt="image" width="80px" height="50px"></td>
							<td>{{$v->act_desc}}</td>
							<td>	
							<a href="activitysave?id={{$v->act_id}}">
								   <button class="btn btn-xs btn-info">
										<i class="icon-edit bigger-120"></i>
									</button>
							</a>
							
							<a href="activitydel?id={{$v->act_id}}">
									<button class="btn btn-xs btn-danger">
										<i class="icon-trash bigger-120"></i>
									</button>
							</a>
                            </td>
                            </tr>
						</tbody>
						 @endforeach
				       </table>
				       <ul class="pagination">
				        <li  class="disabled"><a href="javascript:search(1)">首页</a></li>
						<li><a href="javascript:search({{$data['last']}})">上一页</a></li>
						<li><a href="javascript:search({{$data['next']}})">下一页</a></li>
						<li><a href="javascript:search({{$data['pages']}})">尾页</a></li>
						</ul>
			        </div><!-- /.table-responsive -->
		   </div><!-- /span -->
	 </div><!-- /row -->