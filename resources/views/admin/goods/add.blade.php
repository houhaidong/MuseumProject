@extends("layouts.admin")


@section("section")

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
	<div class="main-container">
		<div class="container-fluid">
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-md-7">
						<div class="page-breadcrumb-wrap">
							<div class="page-breadcrumb-info">
								<h2 class="breadcrumb-titles" >创建展品<small> 面板 </small>   </h2>
								<ul class="list-page-breadcrumb">
									<li><a href="#">Home</a>
									</li>
									<li><a href="#"> 展品列表 </a>
									</li>
									<li class="active-page"> 创建展品</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						{{--<div class="btn-group pull-right " style="margin-top:30px;">
                             <a  href='{{url('admin/addGood')}}' type="button" class="btn btn-default"><i class="ico-plus"></i> Add New Goods</a>
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
									<h2 class="font"> 创建展品 </h2>
									<p class="font">
										在这里你可以创建新的展品。
									</p>
								</div>
								<form id="SignUpForm"  class="form-horizontal" action="{{url('admin/store')}}" method="post" onsubmit="return checkData()" >
									{{csrf_field()}}
									<div class="form-group">
										<label class="col-lg-3 control-label font">展品名称</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="title" placeholder="展品名称"/>
										</div>
									</div>
									<div class="form-group"  id="mp">
										<label class="col-lg-3 control-label font">展品图片</label>
										<div class="col-lg-4">
											<div class="imgShow">

											</div>
											<div id="imgPicker" class="wu-example">

											</div>
											<div class="progress" style="display: none;">
												<div class="progress-bar progress-bar-striped active" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 70%">
												</div>
											</div>
											<input id="pic" type="hidden" class="form-control inputMap"   name="pic" placeholder="展品图片" value=""/>
										</div>
									</div>
									<div class="form-group" id="mu" >
										<label class="col-lg-3 control-label font">展品音频</label>
										<div class="col-lg-5">
											<div class="listening">

											</div>
											<div id="listenShow" class="wu-example" display:none>

											</div>
											<div class="progress" style="display: none;">
												<div class="progress-bar progress-bar-striped active" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 70%">
												</div>
											</div>
											<input id="music" type="hidden" class="form-control music"   name="music" placeholder="展品音频" value=""/>
										</div>
									</div>

									<div class="form-group"  id="hb">
										<label class="col-lg-3 control-label font">视频海报</label>
										<div class="col-lg-4">
											<div class="imgShowhb">

											</div>
											<div id="imgPickerhb" class="wu-example" display:none>

											</div>
											<div class="progresshb" style="display: none;">
												<div class="progress-bar progress-bar-striped active" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 10%">
												</div>
											</div>
											<input type="hidden" class="form-control inputMaphb" name="hb" placeholder="海报图片" value=""/>
										</div>
									</div>

									<div class="form-group"  id="vi">
										<label class="col-lg-3 control-label font">视频文件</label>
										<div class="col-lg-4">
											<div class="videoing">

											</div>
											<div id="videoShow" class="wu-example" display:none>

											</div>
											<div class="progress" style="display: none;">
												<div class="progress-bar progress-bar-striped active" id="jd" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 10%">
												</div>
											</div>
											<input type="hidden" class="form-control audio"   name="audio" placeholder="景点视频" value=""/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-3 control-label font">所属地图</label>
										<div class="col-lg-4">
											<select class="form-control" name="map">
												@foreach($project as $k)
													<option value="{{$k->id}}">{{$k->pname}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-3 control-label font">VR链接</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="ARURL" placeholder="VR链接"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-3 control-label  font">展品介绍</label>
										<label class="col-lg-3" style="color:red;">上传图片大小在5M以内</label>
										<textarea placeholder="" class="col-lg-9" style="" class="form-control" id="content" name="content"></textarea>
									</div>

									<div class="page-header">

										<p class="font">

										</p>
									</div>
									<div class="form-group">
										<label class="col-lg-9  col-lg-offset-3  font">以下是微信摇一摇申请到的设备信息</label>
									</div>


									<div class="form-group">
										<label class="col-lg-3 control-label  font">设备UUID</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="uuid" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label  font">设备Major</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="major" placeholder="设备Major"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label  font">设备Minor</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="minor" placeholder="设备Minor"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-3 control-label  font">触发距离</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="distance" placeholder="触发距离"/>
										</div>
									</div>

									{{--  <div class="form-group">
                                          <label class="col-lg-3 control-label  font">设备说明</label>
                                          <div class="col-lg-4">
                                              <input type="text" class="form-control"  name="descript" placeholder="设备说明"/>
                                          </div>
                                      </div>--}}

									<div class="form-group">
										<div class="col-lg-4 col-lg-offset-3">
											<div id="check-show" style="height:30px;width: 290px;display: none;">
												<span style="color: red;">展品名称、展品图片、展品音频不能为空</span>
											</div>
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



@endsection

@section("js")

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

					innerHTML:"选择一张展品图片"

				},

				// 只允许选择图片文件。
				accept: {
					title: 'Images',
					extensions: 'gif,jpg,jpeg,bmp,png',
					mimeTypes: 'image/jpg,image/jpeg,image/png'
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
				$(".imgShow img").attr('width','200');
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
				var remove =  "<span class=\'btn btn-danger btn-sm thumbnail2 \' style=\"float:right;\">移除</span>"
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
					mimeTypes: 'image/jpg,image/jpeg,image/png'
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
					mimeTypes: 'video/mp4,video/AVI,video/RM,video/wmv,video/asf,video/flv'
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
			$('#promptButton').css({"display":"block"});
			$('#addPrompt').css({"display":"none"});
			var promptStarttime = $('#promptStarttime').val();
			var promptEndtime = $('#promptEndtime').val();
			var promptContent = $('#promptContent').val().replace(/[\r\n]/g,"&H");
			var promptContent1 = $('#promptContent').val();
			var str = '<div class="form-group" id="'+i+'">';
			str += '<label class="col-lg-3 control-label font"></label>';
			str += '<div id="" class="col-lg-7">';
			str += '<div>';
			str += '<span>有效期：'+promptStarttime+'至'+promptEndtime+'</span>';
			str += '<span style="margin-left: 50px" onclick="delPrompt('+i+')">删除</span><span style="margin-left:40px" onclick="editPrompt(\''+promptStarttime+'\',\''+promptEndtime+'\',\''+promptContent+'\',\''+i+'\')">修改</span>';
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
				var id = e.value;
				$('#'+id).remove();
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


		function checkData(){
			var pic = $('#pic').val();
			var music = $('#music').val();
			if(pic == '' || music == ''){
				$('#check-show').show();
				return false;
			}
			return true;
		}
	</script>




@endsection
