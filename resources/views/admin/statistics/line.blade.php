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
                                        <input type="text"  id="promptStarttime" class="" />
                                        <input type="hidden"  id="starttime" value="" class="" />
                                        <span>至</span>
                                        <input type="text"  id="promptEndtime" class="" />
                                        <input type="hidden"  id="endtime" value="" class="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="width: 80%; height:20px;margin: 0 auto;text-align: right;margin-top: 10px;">
                            <button style="margin-right: 20px;" type="button" class="btn btn-primary btn-sm" onclick="chaxun()">查询</button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="quxiao()">重置</button>
                        </div>
                        <div style="clear: both"></div>
                        <div id="" style="width: 100%;">
                            <div id="main" style="width: 900px;height: 900px;">

                            </div>
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
        /*图标插件*/
        var myChart = echarts.init(document.getElementById('main'));
        var option = {
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },

            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true,
                backgroundColor:'#333'

            },
            xAxis:  {
                type: 'value'
            },
            yAxis: {
                type: 'category',
                data: ['周一','周二','周三','周四','周五','周六','周日']
            },
            series: [
                {
                    name: '',
                    type: 'bar',
                    stack: '',
                    itemStyle: {
                        normal: {
                            color: '#333'
                        }
                    },
                    label: {
                        normal: {
                            show: true,
                            position: 'insideRight'
                        }
                    },
                    data: [820, 832, 901, 934, 1290, 1330, 1320]
                }
            ]
        };
        myChart.setOption(option);
        var data = '<?php echo json_encode($data);?>';
        var arr = eval(data);
        //console.log(arr);
        var exhibitname = new Array();
        var exhibitnum = new Array();
        for(i=0;i<arr.length;i++){

            exhibitname.push(arr[i].title);
           exhibitnum.push(arr[i].num)
        }
        myChart.setOption({
            yAxis:{
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

    </script>
<script>
    function quxiao(){
        location.reload();
    }
    var arr = new Array();
    function chaxun(){
        var startTime = $('#starttime').val();
        var endTime = $('#endtime').val();
        if(startTime == ''){
            startTime = '2016-01-01 00:00:00'
        }
        if(endTime == ''){
            endTime = '3016-01-01 00:00:00'
        }
        $.ajax({
            url: 'ajaxLine'+'/starttime/'+startTime+'/endtime/'+endTime,
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: '',
            type: 'get',
            datatype: 'json',
            success: function (e) {
                var data = JSON.parse(e);
                console.log(data);
                console.log(data.length);
                var exhibitname = new Array();
                var exhibitnum = new Array();
                for(i=0;i<data.length;i++){

                    exhibitname.push(data[i].title);
                    exhibitnum.push(data[i].num)
                }
                console.log(exhibitname)
                myChart.setOption({
                    yAxis:{
                        data:exhibitname
                    },
                    series:{
                        data:exhibitnum
                    }
                });

            }
        })
    }
</script>

@endsection
