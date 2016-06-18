<div class="table-responsive">

		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="center">编号</th>
					<th>添加人</th>
					<th>标题</th>
					<th>时间</th>
					<th>图片</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
       		@foreach($data as $v)
			
				<tr>
					<td class="center">{{$v->ar_id}}</td>
					<td>{{$v->adm_name}}</td>

				<!-- 文章标题的即点即改 -->

                    <td onclick="fun1({{$v->ar_id}})">

  <input type="text" value="{{$v->ar_title}}" id="i{{$v->ar_id}}" onblur="fun2({{$v->ar_id}})" style="display:none"  /> 
   <span id="s{{$v->ar_id}}">{{$v->ar_title}}</span>

                    </td>

				<!-- 结束 -->
					<td>{{ date('Y-m-d H-i-s',$v->ar_time)}}</td>
					<td><img src="{{$v->ar_img}}" alt="image" width="80px" height="50px"></td>
					<td>
						<a href="articlesave?id={{$v->ar_id}}">
						   <button class="btn btn-xs btn-info">
								<i class="icon-edit bigger-120"></i>
							</button>
						</a>
						<a href="articledel?id={{$v->ar_id}}">	
							<button class="btn btn-xs btn-danger">
								<i class="icon-trash bigger-120"></i>
							</button>
						</a>
                    </td>
                   </tr>
           	@endforeach	
			</tbody>
		
		       </table>
		      <?php echo $data->appends(['adm_id' => $adm_id,'ar_title'=>$ar_title])->render(); ?>
	        </div>