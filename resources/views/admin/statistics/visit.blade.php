@extends("layouts.admin")



@section("section")
    <style>
        .padder-lg {
            padding-left: 30px;
            padding-right: 30px;
        }
        .scrollable {
            overflow-x: hidden;
            overflow-y: auto;
        }
        .row-sm {
            margin-left: -10px;
            margin-right: -10px;
        }
        .row-sm > div {
            padding-left: 10px;
            padding-right: 10px;
        }
        .pos-rlt {
            position: relative;
        }
        .padder-v {
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .item .opacity {
            background-color: rgba(0,0,0,0.75);
        }

        .item-overlay {
            display: none;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
        .r-2x {
            border-radius: 4px;
        }
        .r {
            border-radius: 2px 2px 2px 2px;
        }
        .bg-black {
            background-color: #232c32;
            color: #7d94a4;
        }

        .item .center {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
        }

        .m-t-n {
            margin-top: -15px;
        }
        .text-ellipsis {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .text-xs {
            font-size: 12px;
        }
        .text-muted {
            color: #939aa0;
        }

        .item-overlay.active, .item:hover .item-overlay {
            display: block;
        }

        .item .opacity {
            background-color: rgba(0,0,0,0.75);
        }
        .item-overlay {
            display: none;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
        .r-2x {
            border-radius: 4px;
        }
        .r {
            border-radius: 2px 2px 2px 2px;
        }
        .bg-black {
            background-color: #232c32;
            color: #7d94a4;
        }

        .img-full {
            width: 100%;
        }
        .r-2x {
            border-radius: 4px;
        }
        .r {
            border-radius: 2px 2px 2px 2px;
        }

        a {
            color: #545a5f;
            text-decoration: none;
        }
        a:hover {
            color: #545a5f;

            text-decoration: none;
        }
    </style>
    <div class="main-container">
        <div class="container-fluid">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-md-7">
                        <div class="page-breadcrumb-wrap">

                            <div class="page-breadcrumb-info">
                                <h2 class="breadcrumb-titles  font">统计列表 <small>面板</small></h2>
                                <ul class="list-page-breadcrumb">
                                    <li><a href="#">后台首页</a>
                                    </li>
                                    <li class="active-page">数据统计</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="widget-block">
                    <div class="table-responsive">
                        <div class="statistics-time" style="width: 100%;">
                            <div class="statistics" style="/*border: 1px solid green;*/width: 100%;height: 60px;">
                                <div style="/*border: 1px solid yellow;*/width: 50%;height: 60px;text-align: center;line-height: 60px;">
                                    <div>
                                        <span>统计时间：</span>
                                        <input type="text"  id="promptStarttime" value="" class="" />
                                        <input type="hidden"  id="starttime" value="" class="" />
                                        <span>至</span>
                                        <input type="text"  id="promptEndtime" value="" class="" />
                                        <input type="hidden"  id="endtime" value="" class="" />
                                    </div>
                                </div>
                                <div style="/*border: 1px solid black;*/width: 100%;height: 60px;line-height: 60px;">
                                    <div>
                                        <span style="float: left;margin-left:3%">统计展品:</span>
                                        <div style="border: 1px solid purple;width: 80%;height:100px;float:left;margin-left: 24px; overflow-x:hidden;overflow-y:auto;">
                                            @foreach($data as $v)
                                                <p style="width: 33.33%;float: left;">
                                                    <input type="checkbox" value="{{$v->id}}" name="exhibit{{$v->id}}" id="exhibit{{$v->id}}" onclick="checkexhibit({{$v->id}})" style="margin-left: 25px"><label  for="exhibit{{$v->id}}">{{$v->title}}</label>
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both"></div>
                        <div id="notice" style="width: 80%; height:20px;margin: 0 auto;margin-top: 10px;text-align: left;">不能为空，并且只能选择十个展品</div>

                        <div style="width: 80%; height:20px;margin: 0 auto;text-align: right;margin-top: 10px;">
                            <button style="margin-right: 20px;" type="button" class="btn btn-primary btn-sm" onclick="chaxun()">查询</button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="quxiao()">重置</button>
                        </div>
                        <div id="chart" style="width: 100%;">
                            <div id="main" style="width: 700px;height:350px;margin: 0 auto">

                            </div>
                        </div>
                        <div id="data">
                            <table id="tab" class="table table-striped table-hover table-bordered matmix-dt">
                            <thead>
                            <tr>
                                <th colspan="11">
                                    <div class="dt-col-header font"></div>
                                </th>
                            </tr>
                            <tr>
                                <th class="tc-center font">
                                    展品
                                </th>
                                @foreach($exhibit as $v )
                                    <th class="tc-center font">
                                        {{$v->exhibitName}}
                                    </th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="tc-center font">
                                    参观人次
                                </td>
                                @foreach($exhibit as $v )
                                    <td class="tc-center font">
                                        {{$v->num}}
                                    </td>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="dt-pagination">
                        <nav>
                            <ul class="pagination">


                            </ul>
                        </nav>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
@section("js")
    <script src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript">
        function checkexhibit(val){
            if(typeof($("#exhibit"+val).attr("check")) !== "undefined"){
                $('#exhibit'+val).removeAttr('check','1');
            }else{
                $('#exhibit'+val).attr('check','1');
            }

        }
        /*图标插件*/
        var myChart = echarts.init(document.getElementById('main'));
        var option = {
            color: ['#3398DB'],
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '15%',
                y2:140,
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data : [],
                    axisTick: {
                        alignWithLabel: true
                    },
                    axisLabel:{
                        interval: 0,
                        rotate:-30
                    }

                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name:'',
                    type:'bar',
                    barWidth: '60%',
                    data:[1, 52, 200, 334, 390, 330, 220, 220, 220, 220]
                }
            ]
        };
        var data = '<?php echo json_encode($exhibit);?>';
        var arr = eval(data);
        var exhibitname = new Array();
        var exhibitnum = new Array();
        for(i=0;i<arr.length;i++){
//            alert()
            exhibitname.push(arr[i].exhibitName);
            exhibitnum.push(arr[i].num)
        }
        myChart.setOption(option);
        console.log(exhibitname);
        myChart.setOption({
            xAxis:{
                data:exhibitname
            },
            series:{
                data:exhibitnum
            }
        });


        /*日期插件*/
        jeDate({
            dateCell:"#promptStarttime",
            format:"YYYY-MM-DD hh:mm:ss ",
            isinitVal:false,
            ishmsVal:false,
            isTime:true, //isClear:false,
            minDate:"2014-09-19 00:00:00",
            choosefun:function(val){
               $('#starttime').val(val);
            },
            okfun:function(val){
                $('#starttime').val(val);
            }
        })

        jeDate({
            dateCell:"#promptEndtime",
            format:"YYYY-MM-DD hh:mm:ss",
            isinitVal:false,
            ishmsVal:true,
            isTime:true, //isClear:false,
            hmsLimit:false,
            minDate:"2014-09-19 00:00:00",
            choosefun:function(val){
                $('#endtime').val(val);
            },
            okfun:function(val){
                $('#endtime').val(val);
            }
        })



        {{--  $(function(){
              $('#table_id_example').DataTable({
                  "info": false,
                  "lengthChange": false,
                  "ordering": false,
                  "searching": false
              });
          });--}}
    </script>
    <script type="text/javascript">
        function quxiao(){
            $("[type='checkbox']").removeAttr("checked");
            $("[type='checkbox']").removeAttr('check','1');
        }
            var arr = new Array();
            function chaxun(){
            arr.splice(0,arr.length);
            $('[check=1]').each(function(index,item){
                arr[index] = $(this).val();
            });
            if(arr.length > 10 || arr.length < 1){
             $('#notice').css('color','red');
                return false;
            }else{
                $('#notice').css('color','black');
            }
            var str;
            str = arr.join(",");
            var startTime = $('#starttime').val();
            var endTime = $('#endtime').val();
            if(startTime == ''){
                startTime = '2016-01-01 00:00:00'
            }
            if(endTime == ''){
                endTime = '3016-01-01 00:00:00'
            }
            $.ajax({
                url: 'ajaxVisit'+'/starttime/'+startTime+'/endtime/'+endTime+'/exhibitid/'+str,
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                data: '',
                type: 'get',
                datatype: 'json',
                success: function (e) {
                   var data = JSON.parse(e);
                   var arrName = [];
                    var arrData = [];
                    data.forEach(function(index,item){
                       arrName.push(index.exhibitName);
                       arrData.push(index.num);
                    });
                    myChart.setOption({
                        xAxis:{
                            data:arrName
                        },
                        series:{
                            data:arrData
                        }
                    });
                    $('#tab').remove();
                    var str = '<table id="tab2" class="table table-striped table-hover table-bordered matmix-dt"><thead><tr><th colspan="'+(arr.length)+1+'"> <div class="dt-col-header font"></div></th><tr><tr><th class="tc-center font">展品</th>';
                            data.forEach(function(index,item) {
                                str += '<th class="tc-center font">' + index.exhibitName + '</th>'
                            })
                        str +='</tr></thead><tbody><tr><td class="tc-center font">参观人次</td>';
                            data.forEach(function(index,item) {
                                str += '<td class="tc-center font">' + index.num + '</td>';
                            })
                        str += '</tr></tbody></table>';
                    $('#tab2').remove();
                    $('#data').after(str);
                }
            })
        }
    </script>

@endsection
