<div class="table-responsive">

                      <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th class="center">编号</th>
                            <th>酒店名称</th>
                            <th>酒店备注</th>
                            <th>酒店图</th>
                            <th>酒店类型</th>
                            <th>酒店地址</th>
                            <th>酒店描述</th>
                            <th>酒店电话</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                                            @foreach($data['data'] as $k => $v)
                        <tbody>
                          <tr>
                            <td class="center" id="h_id">{{$v->h_id}}</td>
                                                        <td>{{$v->h_name}}</td>
                            <td>{{$v->h_beizhu}}</td>
                            <td><img src="uploads/{{$v->h_img}}" alt="" width="150px" height="100px"></td>
                            <td>{{$v->h_type}}</td>
                            <td>
                            @foreach($data['area'][$k] as $vv)  
                              {{$vv->region_name}}
                            @endforeach 
                            {{$v->h_address}}
                            </td>
                            <td>{{$v->h_desc}}</td>
                            <td>{{$v->h_tel}}</td>
                            <td>
                                <button class="btn btn-xs btn-info" title="查看户型">
                                  <i class="icon-pencil bigger-120"></i>
                                </button>

                                 <button class="btn btn-xs btn-info" title="编辑" onclick="edit({{$v->h_id}})">
                                  <i class="icon-edit bigger-120"></i>
                                </button>

                                <button class="btn btn-xs btn-danger" title="删除" onclick="del({{$v->h_id}},<?php echo $data['data']->currentPage();?>)">
                                  <i class="icon-trash bigger-120"></i>
                                </button>
                                                        </td>
                                                        </tr>
                          </tbody>
                           @endforeach
                             </table>
                             <?php echo $data['data']->render(); ?>

										       