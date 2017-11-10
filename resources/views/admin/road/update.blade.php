@extends("layouts.admin")

<style type="text/css">
    #imgPicker{
        border:none;
        background: none;
        outline: none;
    }
    .webuploader-element-invisible{
        display: none;
    }
    .webuploader-container {
        position: relative;
    }
    .webuploader-element-invisible {
        position: absolute !important;
        clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
        clip: rect(1px,1px,1px,1px);
    }
    .webuploader-pick {
        position: relative;
        display: inline-block;
        cursor: pointer;
        background: #00b7ee;
        padding: 10px 15px;
        color: #fff;
        text-align: center;
        border-radius: 3px;
        overflow: hidden;
    }
    .webuploader-pick-hover {
        background: #00a2d4;
    }

    .webuploader-pick-disable {
        opacity: 0.6;
        pointer-events:none;
    }


</style>


@section("section")



    <div class="main-container">
        <div class="container-fluid">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-md-7">
                        <div class="page-breadcrumb-wrap">
                            <div class="page-breadcrumb-info">
                                <h2 class="breadcrumb-titles"> 编辑虚拟路牌 <small> 面板 </small></h2>
                                <ul class="list-page-breadcrumb">
                                    <li><a href="#">Home</a>
                                    </li>
                                    <li><a href="#"> 虚拟路牌列表 </a>
                                    </li>
                                    <li class="active-page"> 编辑虚拟路牌 </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        {{--  <div class="btn-group pull-right " style="margin-top:30px;">
                               <a  href='{{url('admin/addGoods')}}' type="button" class="btn btn-default font"><i class="ico-plus"></i>添加新的虚拟路牌</a>
                           </div>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box-widget widget-module no-border">
                        <div class="widget-container">
                            <div class=" widget-block">
                                <div class="page-header">
                                    <h2 class="font">编辑当前虚拟路牌的信息	</h2>
                                    <p class="font">
                                        在这里可以修改虚拟路牌的相关信息。
                                    </p>
                                </div>
                                <form id="SignUpForm"  class="form-horizontal" action="{{url('admin/editRoad').'/'.$data->id}}" method="post" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label font">虚拟路牌名称</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" name="title" placeholder="虚拟路牌名称" value="{{$data->title}}"/>
                                        </div>
                                    </div>
                                   {{-- <div class="form-group"  id="mp">
                                        <label class="col-lg-3 control-label font">虚拟路牌图片</label>
                                        <div class="col-lg-4">
                                            <div class="imgShow" >
                                                @if($pic->resource_name == '')

                                                @else
                                                    <img src="/upload/{{$pic->resource_name}}" class="thumbnail1 thumbnail" width="200px;">
                                                @endif
                                            </div>
                                            @if($pic->resource_name !== '')
                                                <div id="imgPicker" class="wu-example" style="display: none;" >
                                                    @else
                                                        <div id="imgPicker" class="wu-example" >
                                                            @endif

                                                        </div>
                                                        <div class="progress" style="display: none;">
                                                            <div class="progress-bar progress-bar-striped active" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" class="form-control inputMap"   name="pic" placeholder="虚拟路牌图片" value="{{$pic->resource_name}}"/>
                                                </div>
                                        </div>--}}
                                    <input id="pic" type="hidden" class="form-control inputMap"   name="pic" placeholder="虚拟路牌图片" value="guideboard.png"/>

                                        <div class="form-group" id="mu" >
                                            <label class="col-lg-3 control-label font">虚拟路牌音频</label>
                                            <div class="col-lg-5">
                                                <div class="listening" >
                                                    <div class="listening">
                                                        @if($music->resource_name == '')

                                                        @else
                                                            <audio preload="auto" src="/upload/{{$music->resource_name}}" class="au" controls="controls"></audio>
                                                            <span class="btn btn-danger btn-sm thumbnail2 " style="float: right;">移除</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($music->resource_name !== '')
                                                    <div id="listenShow" class="wu-example"  style="display: none;" >
                                                        @else
                                                            <div id="listenShow" class="wu-example" >
                                                                @endif

                                                            </div>
                                                            <div class="progress" style="display: none;">
                                                                <div class="progress-bar progress-bar-striped active" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                                                </div>
                                                            </div>
                                                            <input type="hidden" class="form-control music"   name="music" placeholder="虚拟路牌音频" value="{{$music->resource_name}}"/>
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label font">所属地图</label>
                                                <div class="col-lg-4">
                                                    <select class="form-control" name="map">
                                                        @if($data->map == 1)
                                                            <option value="1" selected="selected">沾化历史文化展</option>
                                                            <option value="2">沾化古代盐业展</option>
                                                        @else
                                                            <option value="1">沾化历史文化展</option>
                                                            <option value="2" selected="selected">沾化古代盐业展</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group"  id="hb">
                                                <label class="col-lg-3 control-label font">视频海报</label>
                                                <div class="col-lg-4">
                                                    <div class="imgShowhb">
                                                        @if( $data->poster == '')

                                                        @else
                                                            <img src="/upload/{{$data->poster}}" class="" width="200px;" onclick="del(this)">

                                                        @endif
                                                    </div>
                                                    @if($data->poster == '' ||$data->poster == null )
                                                        <div id="imgPickerhb" class="wu-example" {{--style="display:none"--}}>
                                                            @else
                                                                <div id="imgPickerhb" class="wu-example" style="display:none">
                                                                    @endif


                                                                </div>
                                                                <div class="progresshb" style="display: none;">
                                                                    <div class="progress-bar progress-bar-striped active" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" class="form-control inputMaphb" name="hb" placeholder="海报图片" value="{{$data->poster}}"/>
                                                        </div>
                                                </div>

                                                <div class="form-group"  id="vi">
                                                    <label class="col-lg-3 control-label font">视频文件</label>
                                                    <div class="col-lg-4">
                                                        <div class="videoing">
                                                            @if($data->video_url !== '')
                                                                <video src="/upload/{{$data->video_url}}" class="vid" style='width:300px;height:300px' controls='controls'></video>
                                                                <span class="btn btn-danger btn-sm thumbnail3 " style="">移除</span>
                                                            @else

                                                            @endif
                                                        </div>
                                                        @if($data->video_url !== '')
                                                            <div id="videoShow" class="wu-example" style="display:none">
                                                                @else
                                                                    <div id="videoShow" class="wu-example">
                                                                        @endif

                                                                    </div>
                                                                    <div class="progress" style="display: none;">
                                                                        <div class="progress-bar progress-bar-striped active" id="jd" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" class="form-control audio"   name="video" placeholder="景点视频" value="{{$data->video_url}}"/>
                                                            </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label  font">虚拟路牌介绍</label>
                                                        <label class="col-lg-3" style="color:red;">上传图片大小在5M以内</label>
												<textarea class="col-lg-9" style=""   class="form-control" id="content" name="content">
													{{$data->content}}
												</textarea>
                                                    </div>

                                                    <div class="page-header">

                                                        <p class="font" style="">
                                                            以下填写的是您在微信摇一摇申请号的beacon设备信息
                                                        </p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label  font">设备UUID</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" class="form-control" name="uuid" placeholder="设备UUID" value="{{$device->uuid}}" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label  font">设备Major</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" class="form-control" name="major" placeholder="设备Major" value="{{$device->major}}" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label  font">设备Minor</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" class="form-control" name="minor" placeholder="设备Minor" value="{{$device->minor}}" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label  font">触发距离</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" class="form-control" name="distance" placeholder="触发距离" value="{{$device->distance}}" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-4 col-lg-offset-3">
                                                            <input type="submit" class="form-control btn btn-success "  value="确认添加"  />
                                                        </div>
                                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>

@endsection

@section("js")
    <script type="text/javascript" src="{{asset('js/webuploader.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/ueditor.config.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/ueditor.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/zh-cn.js')}}"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('content');
        function init(){
            // 初始化Web Uploader
            var imgUpaloader = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: true,

                // swf文件路径
                swf: "{{asset('images/Uploader.swf')}}",


                // 文件接收服务端。
                server: "{{url('admin/uploader')}}",


                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {

                    id:'#imgPicker',
                    // 是否支持多文件上传
                    multiple:false,

                    innerHTML:"选择一张虚拟路牌图片"

                },

                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            imgUpaloader.on( 'fileQueued', function( file ) {

                // 当有文件添加进来的时候
                // console.log("添加进来了")
            });


            // 文件上传过程中创建进度条实时显示。
            imgUpaloader.on( 'uploadProgress', function( file, percentage ) {
                $("#imgPicker").css({"display":"none"});
                $("#mp .progress").css({
                    display:"block"
                });
                $("#mp .progress .progress-bar").css({
                    width:percentage * 100 + '%'
                })

            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            imgUpaloader.on( 'uploadSuccess', function( file ) {

            });


            imgUpaloader.on( 'uploadAccept', function( object ,ret) {
                $(".inputMap").val(ret.filename)
                var img = new Image();
                img.src="/upload/"+ret.filename;
                img.setAttribute("class","thumbnail1 thumbnail")
                $(".imgShow").html(img)
                $('.imgShow img').attr('width','200');
            });



            // 文件上传失败，显示上传出错。
            imgUpaloader.on( 'uploadError', function( file ) {
                alert("上传失败");
                $("#imgPicker").css({"display":"block"});
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            imgUpaloader.on( 'uploadComplete', function( file ) {
                $("#mp .progress").css({"display":"none"});
            });


// -------------------------------------------------------------
            var musicUploader = WebUploader.create({

                auto: true,


                // swf文件路径
                swf: "{{asset('images/Uploader.swf')}}",

                // 文件接收服务端。
                server: '{{url('admin/uploader')}}',

                // 选择文件的按钮。可选。

                // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                resize: false,
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {

                    id:'#listenShow',
                    // 是否支持多文件上传
                    multiple:false,

                    innerHTML:"选择一个音频文件"

                },

            });


            // 文件上传过程中创建进度条实时显示。
            musicUploader.on( 'uploadProgress', function( file, percentage ) {
                $("#listenShow").css({"display":"none"});
                $("#mu .progress").css({
                    display:"block"
                });
                $("#mu .progress .progress-bar").css({
                    width:percentage * 100 + '%'
                })

            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            musicUploader.on( 'uploadSuccess', function( file ) {

            });


            musicUploader.on( 'uploadAccept', function( object ,ret) {
                $(".music").val(ret.filename)
                var img = new Audio();
                img.src="/upload/"+ret.filename;
                img.setAttribute("class","au");
                img.setAttribute("controls","controls");
                var remove =  "<span class=\'btn btn-danger btn-sm thumbnail2 \' style=\'float: right;\''>移除</span>"
                $(".listening").html(img)
                $(".listening").append(remove)
            });



            // 文件上传失败，显示上传出错。
            musicUploader.on( 'uploadError', function( file ) {
                alert("上传失败");
                $("#listening").css({"display":"block"});
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            musicUploader.on( 'uploadComplete', function( file ) {
                $("#mu .progress").css({"display":"none"});
            });

        }
        init();

        /*上传视频海报*/
        function haibao(){
            var imgUpaloader2 = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: true,

                // swf文件路径
                swf: "{{asset('images/Uploader.swf')}}",


                // 文件接收服务端。
                server: "{{url('admin/uploader')}}",


                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {

                    id:'#imgPickerhb',
                    // 是否支持多文件上传
                    multiple:false,

                    innerHTML:"选择一张海报图片"

                },

                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            imgUpaloader2.on( 'fileQueued', function( file ) {

                // 当有文件添加进来的时候
                // console.log("添加进来了")
            });


            // 文件上传过程中创建进度条实时显示。
            imgUpaloader2.on( 'uploadProgress', function( file, percentage ) {
                $("#imgPickerhb").css({"display":"none"});
                $("#hb .progresshb").css({
                    display:"block"
                });
                $("#hb .progresshb .progress-bar").css({
                    width:percentage * 100 + '%'
                })

            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            imgUpaloader2.on( 'uploadSuccess', function( file ) {

            });


            imgUpaloader2.on( 'uploadAccept', function( object ,ret) {
                $(".inputMaphb").val(ret.filename)
                var img = new Image();
                img.src="/upload/"+ret.filename;
//			img.setAttribute("class","thumbnail1 thumbnail")
//			img.setAttribute("class","xs")
                $(".imgShowhb").html(img)
                $(".imgShowhb img").attr('width','100');
                $(".imgShowhb img").attr('height','100');
                $(".imgShowhb img").attr("onclick","del(this)");
            });



            // 文件上传失败，显示上传出错。
            imgUpaloader2.on( 'uploadError', function( file ) {
                alert("上传失败");
                $("#imgPickerhb").css({"display":"block"});
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            imgUpaloader2.on( 'uploadComplete', function( file ) {
                $("#hb .progresshb").css({"display":"none"});
            });

        }
        haibao();

        /*上传按钮1*/
        function buttonOne(){
            var imgUpaloader3 = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: true,

                // swf文件路径
                swf: "{{asset('images/Uploader.swf')}}",


                // 文件接收服务端。
                server: "{{url('admin/uploader')}}",


                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {

                    id:'#imgPickeran',
                    // 是否支持多文件上传
                    multiple:false,

                    innerHTML:"选择一张按钮图片"

                },

                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            imgUpaloader3.on( 'fileQueued', function( file ) {

                // 当有文件添加进来的时候
                // console.log("添加进来了")
            });


            // 文件上传过程中创建进度条实时显示。
            imgUpaloader3.on( 'uploadProgress', function( file, percentage ) {
                $("#imgPickeran").css({"display":"none"});
                /* $("#an .progressan").css({
                 display:"block"
                 });
                 $("#an .progressan .progress-bar").css({
                 width:percentage * 100 + '%'
                 })*/

            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            imgUpaloader3.on( 'uploadSuccess', function( file ) {

            });


            imgUpaloader3.on( 'uploadAccept', function( object ,ret) {
                $(".inputMapan").val(ret.filename)
                var img = new Image();
                img.src="/upload/"+ret.filename;
//			img.setAttribute("class","thumbnail1 thumbnail")
//			img.setAttribute("class","xs")
                $(".imgShowan").html(img)
                $(".imgShowan img").attr('width','100');
                $(".imgShowan img").attr('height','100');
                $(".imgShowan img").attr("onclick","delButtonOne(this)");
                $('#aninput1').val(ret.filename);
            });



            // 文件上传失败，显示上传出错。
            imgUpaloader3.on( 'uploadError', function( file ) {
                alert("上传失败");
                $("#imgPickeran").css({"display":"block"});
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            imgUpaloader3.on( 'uploadComplete', function( file ) {
                $("#an .progressan").css({"display":"none"});
            });

        }
        buttonOne();

        /*上传按钮2*/
        function buttonTwo(){
            var imgUpaloader4 = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: true,

                // swf文件路径
                swf: "{{asset('images/Uploader.swf')}}",


                // 文件接收服务端。
                server: "{{url('admin/uploader')}}",


                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {

                    id:'#imgPickeran2',
                    // 是否支持多文件上传
                    multiple:false,

                    innerHTML:"选择一张按钮图片"

                },

                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            imgUpaloader4.on( 'fileQueued', function( file ) {

                // 当有文件添加进来的时候
                // console.log("添加进来了")
            });


            // 文件上传过程中创建进度条实时显示。
            imgUpaloader4.on( 'uploadProgress', function( file, percentage ) {
                $("#imgPickeran2").css({"display":"none"});
                /* $("#an2 .progressan2").css({
                 display:"block"
                 });
                 $("#an2 .progressan2 .progress-bar").css({
                 width:percentage * 100 + '%'
                 })*/

            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            imgUpaloader4.on( 'uploadSuccess', function( file ) {

            });


            imgUpaloader4.on( 'uploadAccept', function( object ,ret) {
                $(".inputMapan2").val(ret.filename)
                var img = new Image();
                img.src="/upload/"+ret.filename;
//			img.setAttribute("class","thumbnail1 thumbnail")
//			img.setAttribute("class","xs")
                $(".imgShowan2").html(img)
                $(".imgShowan2 img").attr('width','100');
                $(".imgShowan2 img").attr('height','100');
                $(".imgShowan2 img").attr("onclick","delButtonTwo(this)");
                $('#aninput2').val(ret.filename);
            });



            // 文件上传失败，显示上传出错。
            imgUpaloader4.on( 'uploadError', function( file ) {
                alert("上传失败");
                $("#imgPickeran2").css({"display":"block"});
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            imgUpaloader4.on( 'uploadComplete', function( file ) {
                $("#an2 .progressan2").css({"display":"none"});
            });

        }
        buttonTwo();


        /*上传视频*/
        function video(){
            var videoUploader = WebUploader.create({

                auto: true,


                // swf文件路径
                swf: "{{asset('images/Uploader.swf')}}",

                // 文件接收服务端。
                server: '{{url('admin/videoUpload')}}',

                // 选择文件的按钮。可选。

                // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                resize: false,
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {

                    id:'#videoShow',
                    // 是否支持多文件上传
                    multiple:false,

                    innerHTML:"选择一个视频文件"

                },
                accept:{
                    title: 'video',
                    extensions: 'mp4,AVI,RM,wmv,asf,mov,flv',
                    mimeTypes: 'video/*'
                },
                chunked:true,
                chunkSize:100*1024*1024,

            });
            // 文件上传过程中创建进度条实时显示。
            videoUploader.on( 'uploadProgress', function( file, percentage ) {
                $("#videoShow").css({"display":"none"});
                $("#vi .progress").css({
                    display:"block"
                });
                $("#jd").css({
                    width:percentage * 100 + '%'
                })

            });
            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            videoUploader.on( 'uploadSuccess', function( file,response ) {
                var str = "<video src='/"+response.filePath+"' style='width:300px;height:300px' controls='controls'></video>";
                $('.audio').val(response.fileName);
                $('.videoing').html(str);
//				var remove =  "<span class=\'btn btn-danger btn-sm thumbnail3 \' style=\'margin-top: -24px;\''>移除</span>"
//				$(".videoing").append(remove)
            });


            videoUploader.on( 'uploadAccept', function( object ,ret) {

                /*$(".inputMap").val(ret.filename)
                 var img = new Image();
                 img.src="/upload/"+ret.filename;
                 //			img.setAttribute("class","thumbnail1 thumbnail")
                 //			img.setAttribute("class","xs")
                 $(".imgShow").html(img)
                 $(".imgShow img").attr('width','100');
                 $(".imgShow img").attr('height','100');
                 $(".imgShow img").attr("onclick","del(this)");*/
            });



            // 文件上传失败，显示上传出错。
            videoUploader.on( 'uploadError', function( file,reason  ) {
                alert("上传失败");
                alert(reason);
//			$("#videoPicker").css({"display":"block"});
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            videoUploader.on( 'uploadComplete', function( file ) {
                $("#vi .progress").css({"display":"none"});
            });

        }
        video();


        function del(obj){

            //$(".imgShow").find("img[id='"+id+"']").remove();
            layer.confirm('你确认删除图片么？', {
                offset:'100px',
                btn: ['确认','取消'] //按钮
            },function(index){
                layer.close(index)
                obj.remove();
                $(".inputMaphb").val("");
//			$('.thumbnail1').hide();
                $("#imgPickerhb").css({"display":"block"});
                init();
                haibao();
            },function(){
                layer.close()
            });
        }
        function delButtonOne(obj){

            //$(".imgShow").find("img[id='"+id+"']").remove();
            layer.confirm('你确认删除图片么？', {
                offset:'100px',
                btn: ['确认','取消'] //按钮
            },function(index){
                layer.close(index)
                obj.remove();
                $(".inputMapan").val("");
//			$('.thumbnail1').hide();
                $("#imgPickeran").css({"display":"block"});
                $('#aninput1').val('');
                init();
                haibao();
                buttonOne();
            },function(){
                layer.close()
            });
        }
        function delButtonTwo(obj){

            //$(".imgShow").find("img[id='"+id+"']").remove();
            layer.confirm('你确认删除图片么？', {
                offset:'100px',
                btn: ['确认','取消'] //按钮
            },function(index){
                layer.close(index)
                obj.remove();
                $(".inputMapan2").val("");
//			$('.thumbnail1').hide();
                $("#imgPickeran2").css({"display":"block"});
                $('#aninput2').val('');
                init();
                haibao();
                buttonOne();
                buttonTwo();
            },function(){
                layer.close()
            });
        }


        $(document).on("click",'.thumbnail1',function(){

            layer.confirm('你确认删除图片么？', {
                offset:'100px',
                btn: ['确认','取消'] //按钮
            }, function(index){
                layer.close(index)
                $(".inputMap").val("");
                $('.thumbnail1').hide();
                $("#imgPicker").css({"display":"block"});
                init();
                haibao();
            }, function(){

                layer.close()


            });

        })

        $(document).on("click",'.thumbnail2',function(){
            layer.confirm('你确认移除音频么？', {
                offset:'100px',
                btn: ['确认','取消'] //按钮
            }, function(index){
                layer.close(index)
                $(".music").val("");
                $('.au').remove();
                $('.thumbnail2').remove();
                $("#listenShow").css({"display":"block"});
                init();
            }, function(){

                layer.close()


            });

        })

        $(document).on("click",'.thumbnail3',function(){
            layer.confirm('你确认移除视频吗？', {
                offset:'100px',
                btn: ['确认','取消'] //按钮
            }, function(index){
                layer.close(index)
                $(".audio").val("");
                $('.vid').remove();
                $('.thumbnail3').remove();
//						$('.videoing').remove();
                $("#videoShow").css({"display":"block"});
                video();
            }, function(){

                layer.close()


            });

        })

        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                layer.alert('{{$error}}')
        @endforeach
        @endif

    </script>
    <script>
        function promptShow(status){
            if(status == 1){
                $('#promptStarttime').val('');
                $('#promptEndtime').val('');
                $('#promptContent').val('');
                $('#promptButton').css({"display":"none"});
                $('#addPrompt').css({"display":"block"});

                $('#addButton').css({'display':'block'});
                $('#editButton').css({'display':'none'});
            }else{
                $('#promptButton').css({"display":"block"});
                $('#addPrompt').css({"display":"none"});
            }
        }
        var i = 0;
        function showPrompt(status,e){
            i++;
            var id = 'a'+i;
            $('#promptButton').css({"display":"block"});
            $('#addPrompt').css({"display":"none"});
            var promptStarttime = $('#promptStarttime').val();
            var promptEndtime = $('#promptEndtime').val();
            var promptContent = $('#promptContent').val().replace(/[\r\n]/g,"&H");
            var promptContent1 = $('#promptContent').val();
            var str = '<div class="form-group" id="'+id+'">';
            str += '<label class="col-lg-3 control-label font"></label>';
            str += '<div id="" class="col-lg-7">';
            str += '<div>';
            str += '<span>有效期：'+promptStarttime+'至'+promptEndtime+'</span>';
            str += '<span style="margin-left: 50px" onclick="delPrompt(\''+id+'\')">删除</span><span style="margin-left:40px" onclick="editPrompt(\''+promptStarttime+'\',\''+promptEndtime+'\',\''+promptContent+'\',\''+id+'\')">修改</span>';
            str += '</div>';
            str += '<div class="col-lg-11" style="border: 1px solid #c3b6b6;margin-top: 10px">';
            str += '<span>'+promptContent1+'</span>';
            str += '</div></div>';
            str += '<input type="hidden" name="promptStartTimeShow[]" value="'+promptStarttime+'">';
            str += '<input type="hidden" name="promptEndTimeShow[]" value="'+promptEndtime+'">';
            str += '<input type="hidden" name="promptContentShow[]" value="'+promptContent1+'"></div>';
            if(status == 'add'){
                $('#abc').after(str);
            }else{
                var ids = e.value;
                $('#'+ids).remove();
                $('#abc').after(str);

            }
        }
        /*修改*/
        function editPrompt(start,end,con,id){

            $('#promptButton').css({"display":"none"});
            $('#addPrompt').css({"display":"block"});

            $('#addButton').css({'display':'none'});
            $('#editButton').val(id);
            $('#editButton').css({'display':'block'});


            $('#promptStarttime').val(start);
            $('#promptEndtime').val(end);
            var str;
            str = con.replace(/&H/g,"\r\n");
            $('#promptContent').val(str);
        }

        /*删除*/
        function delPrompt(id){
            $('#'+id).remove();
        }
        jeDate({
            dateCell:"#promptStarttime",
            format:"YYYY-MM-DD hh:mm:ss",
            isinitVal:true,
            isTime:true, //isClear:false,
            minDate:"2014-09-19 00:00:00",
        })

        jeDate({
            dateCell:"#promptEndtime",
            format:"YYYY-MM-DD hh:mm:ss",
            isinitVal:true,
            isTime:true, //isClear:false,
            minDate:"2014-09-19 00:00:00",
        })
        function delButton(id){
            $.ajax({
                url: "{{asset('admin/delButton/')}}" + '/' + id,
                type: 'Get',
                data: {'a':1},
                datatype: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success:function($res){
                    window.location.reload();
                }
            })
        }
    </script>



@endsection
