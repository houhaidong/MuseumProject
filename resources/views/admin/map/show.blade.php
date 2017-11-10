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
                                    <th class="tc-center font">
                                        地图名称
                                    </th>
                                    <th class="tc-center font">
                                        操作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $v)
                                    <tr>
                                        <td class="tc-center font">
                                            {{$v->pname}}
                                        </td>
                                        <td class="tc-center font">
                                            <a href="{{route('admin.poi.show',$v->id)}}" class="btn btn-primary btn-sm">标记点位</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>




@endsection
@section("js")





@endsection