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