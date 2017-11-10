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
                                <h2 class="breadcrumb-titles font">虚拟路牌管理 <small class="font">面板</small></h2>
                                <ul class="list-page-breadcrumb" style="margin-top: 10px;">
                                    <li><a href="#" class="font" >后台首页</a>
                                    </li>
                                    <li class="active-page font">虚拟路牌管理</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="btn-group pull-right " style="margin-top:30px;">
                            <a  href='{{url('admin/addRoad')}}' type="button" class="btn btn-default font"><i class="ico-plus"></i> 添加新的虚拟路牌</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="widget-container">
                    <div class="widget-block">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered matmix-dt">
                                <thead>
                                <tr>
                                    <th colspan="7">
                                        <div class="dt-col-header font">虚拟路牌列表</div>
                                        <p class="font">
                                            这里将显示你所有添加过的虚拟路牌
                                        </p>
                                    </th>

                                </tr>
                                <tr>
                                    {{--<th class="tc-center">
                                        #
                                    </th>--}}
                                    <th class="font tc-center">
                                        虚拟路牌名称
                                    </th>
                                    <th class="tc-center font">
                                        所属地图
                                    </th>
                                    <th class="tc-center font">
                                        操作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $value)
                                    <tr>
                                        {{-- <td class="tc-center font">
                                             {{$value->id}}
                                         </td>--}}
                                        <td class="tc-center font">
                                            {{$value->title}}
                                        </td>
                                        <td class="tc-center font">
                                            @if($value->map == 1)
                                                沾化历史文化展
                                            @else
                                                沾化古代盐业展
                                            @endif
                                        </td>
                                        <td class="tc-center fot">
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group" role="group">
                                                    <a href="{{url('admin/updateRoad')."/".$value->id}}" class="btn btn-primary btn-sm">编辑</a>
                                                    <a href="#" onclick="del({{$value->id}})" class="btn btn-warning btn-sm" >删除</a>
                                                </div>
                                            </div>
                                        </td>
                                @endforeach



                                </tbody>
                            </table>
                        </div>
                        <div class="dt-pagination">
                            <nav>
                                <ul class="pagination">
                                    {{ $data->links() }}
                                    {{--<li>
                                    <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">Prev</span>
                                    </a>
                                    </li>
                                    <li><a href="#">1</a>
                                    </li>
                                    <li><a href="#">2</a>
                                    </li>
                                    <li><a href="#">3</a>
                                    </li>
                                    <li><a href="#">4</a>
                                    </li>
                                    <li><a href="#">5</a>
                                    </li>
                                    <li>
                                    <a href="#" aria-label="Next">
                                    <span aria-hidden="true">Next</span>
                                    </a>
                                    </li>--}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>


                <!--

                <div class=" col-md-4">
                  <div class="item">
                    <div class="pos-rlt">
                      <div class="item-overlay opacity r r-2x bg-black">
                        <div class="center text-center m-t-n">
                          <a href="video-detail.html"><i class="fa fa-play-circle i-2x"></i></a>
                        </div>
                      </div>
                      <a href="video-detail.html"><img src="{{asset('images/m43.jpg')}}" alt="" class="r r-2x img-full"></a>
                    </div>
                    <div class="padder-v">
                      <a href="video-detail.html" class="text-ellipsis">Phasellus at ultricies nequ</a>
                      <a href="video-detail.html" class="text-ellipsis text-xs text-muted">Volutpat</a>
                    </div>
                  </div>
                </div>


                <div class=" col-md-4">
                  <div class="item">
                    <div class="pos-rlt">
                      <div class="item-overlay opacity r r-2x bg-black">
                        <div class="center text-center m-t-n">
                          <a href="video-detail.html"><i class="fa fa-play-circle i-2x"></i></a>
                        </div>
                      </div>
                      <a href="video-detail.html"><img src="{{asset('images/m43.jpg')}}" alt="" class="r r-2x img-full"></a>
                    </div>
                    <div class="padder-v">
                      <a href="video-detail.html" class="text-ellipsis">Phasellus at ultricies nequ</a>
                      <a href="video-detail.html" class="text-ellipsis text-xs text-muted">Volutpat</a>
                    </div>
                  </div>
                </div>



                <div class=" col-md-4">
                  <div class="item">
                    <div class="pos-rlt">
                      <div class="item-overlay opacity r r-2x bg-black">
                        <div class="center text-center m-t-n">
                          <a href="video-detail.html"><i class="fa fa-play-circle i-2x"></i></a>
                        </div>
                      </div>
                      <a href="video-detail.html"><img src="{{asset('images/m43.jpg')}}" alt="" class="r r-2x img-full"></a>
                    </div>
                    <div class="padder-v">
                      <a href="video-detail.html" class="text-ellipsis">Phasellus at ultricies nequ</a>
                      <a href="video-detail.html" class="text-ellipsis text-xs text-muted">Volutpat</a>
                    </div>
                  </div>
                </div>-->





            </div>



        </div>
    </div>




@endsection
@section("js")
    <script>
        function del(id){
            var msg = "您确定要删除吗？";
            if (confirm(msg)==true){
                var str = "{{asset('admin/delRoad')}}"+'/'+id;
                window.location.href= str;

            }else{
                return false;
            }
        }
    </script>




@endsection