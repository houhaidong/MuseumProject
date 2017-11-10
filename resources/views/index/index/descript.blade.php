<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
	{{--<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">--}}
	<script src="/build/jquery.js"></script>
	<script src="/build/mediaelement-and-player.min.js"></script>
	<link rel="stylesheet" href="/build/mediaelementplayer.min.css" />
	<script type="text/javascript">
			var windowsWidth = document.documentElement.clientWidth;
    		document.querySelector("html").setAttribute("style","font-size:"+windowsWidth+"px");
	</script>
	<style type="text/css" media="screen">
		*{
			margin:0px;
			padding:0px;
		}
		body{
			font-size: 14px;
			background-color: white;
			font-family:Helvetica;
		}
		.title{
			width:100%;
		}
		@-webkit-keyframes rotation{
			from {-webkit-transform: rotate(0deg);}
			to {-webkit-transform: rotate(360deg);}
		}
		.music11{
			/*border:1px solid yellow;*/
			float: right;
			margin-right: 0.04rem;
			margin-top: -0.02rem;
			/*border-radius: 25px;
			-webkit-transform: rotate(360deg);
			animation: rotation 3s linear infinite;
			-moz-animation: rotation 3s linear infinite;
			-webkit-animation: rotation 3s linear infinite;
			-o-animation: rotation 3s linear infinite;*/
		}
		#img img{
			width: 100%;
		}
		#img p{
			text-align:left;
			margin-top: 10px;
		}
		.scroll-wrapper {  
  		  -webkit-overflow-scrolling: touch;  
		  overflow-y: scroll;  
		} 
		.bot{
			position:absolute;
			bottom:0px;
			z-index:2;
			overflow:hidden;
		}
	</style>
</head>
<body style="height: 500px;">
<div id="app">
	<div style="width: 100%;text-align: center;margin-bottom: 0.03rem;margin-top: 0.04rem">
		<span class="title" style="font-size: 16px;"><strong>{{$data->title}}</strong></span>
		<img class="music11" id="music11"  width="11%" onclick="stopMusic()">
	</div>
	<div id="img" style="width: 90%;text-align: center;margin:0px auto;height: 500px;overflow: scroll;">
		<?php echo htmlspecialchars_decode($data->content)?>
	</div>
	{{--<div style="border:1px solid white;width:100%;text-align: center">
		<img src="/img/home.png" style="width:0.5rem"  onclick="javascript:window.history.back(-1);" title="返回地图" alt="返回地图" />
		<div style="border: 1px solid white;width: 100%;height: 0.04rem;"></div>
		<div style="border:1px solid red;width: 100%;height: 0.04rem"></div>
	</div>--}}
	<div class="bot" style="width:100%;text-align: center;">
		<img src="/img/home2.png" style="width:100%"  onclick="javascript:window.history.back(-1);" title="返回地图" alt="返回地图" />
	</div>
</div>

<script type="text/javascript">
		if(parent.music_obj.paused){
			$('.music11').attr('src','/img/on.png');
		}else{
			$("#music11").attr("src","/img/off.png")
		}
	function stopMusic(){
		if(parent.music_obj.paused){
			parent.music_obj.play();
			$("#music11").prop("src","/img/off.png")
			$("#tab",window.parent.document).prop("src","/img/off.png")
		}else{
			parent.music_obj.pause();
			$("#music11").prop("src","/img/on.png")
			$("#tab",window.parent.document).prop("src","/img/on.png")
		}
	}


	function generateUUID() {
	var d = new Date().getTime();
	var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
	  var r = (d + Math.random()*16)%16 | 0;
	  d = Math.floor(d/16);
	  return (c=='x' ? r : (r&0x3|0x8)).toString(16);
	});
	return uuid;
	};





	function  total(typeof1,tag) {
	    if(!localStorage.getItem("uid")){
	       localStorage .setItem("uid",generateUUID());
	    }
	    var uid = localStorage.getItem("uid");
	    var data = {"typeof":typeof1,"tag":tag,"uid":uid};
	    $.ajax({
	        url:"http://guobo.wx.youban.aprbrother.com/api/total",
	        type:'post',
	        data:data,
	    })


	}

	function des(url,id){

		total(4,id)
	    location.href = url;

	}








//	$('audio,video').mediaelementplayer();
	parent.music_obj.onended = function(){
 	  $("#tab",window.parent.document).prop("src","/img/on.png");
  	  $("#music11").prop("src","/img/on.png")	
	}

</script>

</body>

</html>
