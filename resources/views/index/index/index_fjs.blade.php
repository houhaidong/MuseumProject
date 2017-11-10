<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/leaflet.css')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="{{asset('css/zhanhua.css')}}" type="text/css">

    <script async src="https://cdn.bootcss.com/lodash.js/4.17.4/lodash.js" charset="utf-8"></script>

    <script src="{{asset('js/leaflet-src-min.js')}}"></script>
    <script src="{{asset('js/Beacon-trigger-plugin.js')}}"></script>
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script async type="text/javascript" src="/layer-v3.0.1/layer/layer.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js" type="text/javascript" charset="utf-8"></script>
    <style>

    </style>
</head>
<body>

<div id="desc" style="width: 100%;z-index: 99999999999999999;display:none;overflow:hidden;">
    <div style="width: 100%;text-align: center;margin-bottom: 0.03rem;margin-top: 0.04rem">
        <span class="title" style="font-size: 20px;"><strong></strong></span>
        <img class="music11" id="music11"  width="11%" onclick="stopMusic()">
    </div>
    <div>
        <div id="aaa" style="width: 100%;text-align: center;margin:0px auto;height:1.6rem;overflow: scroll;">
            <div id="img" style="width: 90%;text-align: center;margin:0px auto">

            </div>
            <div style="height: 0.3rem"></div>
            <div class="video">
                <video id="video" style="width: 100%" controls="controls" poster=""></video>
            </div>
        </div>

        <div  onclick="returnMap()" class="bot" style="background-color:#ffffff;width:100%;text-align: center;height:.12rem;line-height: .12rem;opacity:0.9">
            <span style="color: #b98c59;font-size: 16px">回到地图</span>
        </div>
    </div>
</div>

{{--<input type="hidden" id="openid" value="{{$data}}">--}}

<div id='map' style="">
    {{--<div class="headimg">
        <img id="headimg" src="" alt="" style="width:0.46rem";>
    </div>--}}
   <div class="bottom_exhibit"></div>
    <input type="hidden" id="id" value="13">
</div>
<div id="app" class="exhibitInfo slideOutDown animated hide1" style="visibility:hidden;width:100%;height:.35rem;/*position: relative*/">
    <div style="width: 100%;height: .15rem;text-align: center">
        <img src="/images/zhanhua/vr.png" style="width: .2rem"   onclick="vrJump()" />
        <input type="hidden" id="vr" value="">
    </div>

    <input type="hidden" id="show_layer" value="0">
    <div  style="border:1px  solid lightgrey;width: 95%;height: 0.148rem;background-color: white;margin: 0 auto;display: flex;display: -webkit-flex;justify-content:space-between;border-radius: 3px;position: absolute;bottom: 0;">
        <div style="/*border:1px solid black;*/display: flex;display: -webkit-flex;justify-content:center;align-items:center">
            <img id="tab1" src="" style="width:0.11rem;margin-left: .02rem;" alt="" onclick="Musicstatus()">
            <span id="title" style="font-size:18px;;margin-right:.03rem;margin-left: .02rem"></span>
        </div>
        <div style="/*border: 1px solid yellow;*/display: flex;display: -webkit-flex;justify-content:flex-start;align-items:center;width: 30%;flex:auto">
            <div style="border: 1px solid #666;border-radius:3px;color: #666;font-size: 12px">  &nbsp;&nbsp;目前到达位置&nbsp;&nbsp;</div>
        </div>
        <div class="desc" onclick="descript();" style="/*border: 1px solid blue*/;width:10%;display: flex;display: -webkit-flex;justify-content:center;align-items:center">
            <img src="/images/zhanhua/arrow.png" style="width: 0.03rem" />
        </div>
    </div>
    <audio  id="music" style="display: none;"></audio>
    <audio src="http://opun2zg3k.bkt.clouddn.com/backMusic.mp3" id="backmusic" style="display: none;"></audio>
</div>

<script>
    var  music_obj = document.getElementById("music");
    var  music_back = document.getElementById("backmusic");
    var video_obj = document.getElementById("video");
    var on = '/images/zhanhua/on.png';
    var off = '/images/zhanhua/off.png';
    var imageUrl = "/images/zhanhua/2F.png";
    var imageUrl2 = '/images/zhanhua/3F.png';
    /*切换cdn的url*/
    var all_url = 'http://fjs.test.passbookii.com/upload/';
//    var all_url = 'http://fjs.com/upload/';
    /*api接口的url*/
    var api_url = 'http://fjs.test.passbookii.com/';
//    var api_url = 'http://fjs.com/';
    var height = document.documentElement.clientHeight;
    $('#desc').css('height',height);
    var openid = $('#openid').val();
    var windowsWidth = document.documentElement.clientWidth;
    document.querySelector("html").setAttribute("style","font-size:"+windowsWidth+"px");
    var imgWidth = 1600;
    var imgHeight = 1381;
    var imgWidthF3 = 1600;
    var imgHeightF3 = 1382;
    var exhibit;
    var exhibit2;
    var id = $('#id').val();
    promise =  new Promise(function(resolve,reject){
        $.ajax({
            url:api_url+"exhibit",
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            data:'',
            type:'post',
            datatype:'json',
            success:function(e){
                exhibit = JSON.parse(e);
                B.trigger = exhibit;
                resolve(exhibit)

            }
        });
    });

    /*2f地图*/
    var two = L.imageOverlay(imageUrl,[[-(imgHeight/2),-(imgWidth/2)],[(imgHeight/2),(imgWidth/2)]]);
    /*3f地图*/
    var three = L.imageOverlay(imageUrl2,[[-(imgHeightF3/2),-(imgWidthF3/2)],[(imgHeightF3/2),(imgWidthF3/2)]]);

   var group = new Array();
    var twoMarker =L.layerGroup([two]);
    var threeMarker =L.layerGroup([three]);
    /**
     *楼层
     */
        $.ajax({
            url:api_url+"exhibit",
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            data:'',
            type:'post',
            datatype:'json',
            success:function(e){
                exhibit = JSON.parse(e);
                var myIcon = L.icon({
                    iconUrl: api_url+'images/zhanhua/point_default.png',
                    iconSize: [35,35],
                });
                exhibit.forEach(function(i){
                    if(i.project_id == 13){
                        twoMarker.addLayer(L.marker([i.x, i.y],{icon:myIcon,title:"marker"+ i.id}).on("click",function(ex){

                            trigger(i.mp3, i.title, i.id, i.url);

                        }));
                    }else{
                        threeMarker.addLayer(L.marker([i.x, i.y],{icon:myIcon,title:"marker"+ i.id}).on("click",function(ex){

                            trigger(i.mp3, i.title, i.id, i.url)

                        }));
                    }
                })

            }
        });

    var map = L.map("map",{
        layers:[twoMarker],
        // 修改坐标系
        crs : L.CRS.Simple,
        zoomControl:false,
        // 设置最大拖动边界
        maxBounds :[[-(imgHeightF3/2),-(imgWidthF3/2)],[(imgHeightF3/2),(imgWidthF3/2)]],
        // 设置缩放的最小值
        minZoom : -2,
        // 设置地图放大的最大值W
        maxZoom : 2,
        //设置初始化的缩放值
        zoom:-2,
        //设置地图中心点
        center:[0,-60],
    });
    var zoomControl = L.control.zoom({

        position: 'bottomright'

    });

    map.addControl(zoomControl);


    var baseMaps = {
        "F2": twoMarker,
        "F3": threeMarker
    };



    L.control.layers(baseMaps,'',{'position':'bottomleft','collapsed':false}).addTo(map);

</script>
<script type="text/javascript">

    /*音频*/
    function Musicstatus(){
        $(".exhibitInfo").addClass("slideInUp");
        $(".exhibitInfo").removeClass("slideOutDown");
        if(music_obj.paused){
            music_obj.play();
        }else{
            music_obj.pause();
        }
        if(music_obj.paused){
            $("#tab1").prop("src",""+on);
        }else{
            $("#tab1").prop("src",""+off)
        }
    }

    /*关闭弹框*/
    map.on('click',function(){
        $(".exhibitInfo").removeClass("slideInUp");
        $(".exhibitInfo").addClass("slideOutDown");

        var a = `.leaflet-marker-icon`;
        $(''+a).prop("src","/images/zhanhua/point_default.png");
        music_obj.pause();
    });


    /*详情*/
    function descript(){
        $('#show_layer').val(1);
        var id= $('.desc').attr('id');
        $.ajax({
            url:api_url+"MapDetail/id/"+id,
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            data:'',
            type:'post',
            datatype:'json',
            success:function(e){
                exhibit = JSON.parse(e);
                console.log(exhibit);
                $('.title').text(exhibit.title);
                $('#img').html(exhibit.content);
                if(exhibit.video_url == ''){
                    $('.video').hide();
                }else{
                    video_obj.src = all_url+exhibit.video_url;
                    video_obj.poster = all_url+exhibit.poster;
                }
                $('#desc').show();
                $('#map').hide();
                $(".exhibitInfo").css('display','none');
                // $(".exhibitInfo").addClass("slideOutDown");
                if(music_obj.paused){
                    $('#music11').attr('src',''+on);
                }else{
                    $("#music11").attr("src",""+off)
                }

            }
        });

    }

    /*详情页面的音频的暂停和播放*/
    function stopMusic(){
        if(music_obj.paused){
            music_obj.play();
            $("#music11").prop("src",""+off)
            $("#tab").prop("src",""+off)
        }else{
            music_obj.pause();
            $("#music11").prop("src",""+on)
            $("#tab").prop("src",""+on)
        }
    }
    /*返回地图*/
    function returnMap(){
        // $('#video').css('visibility','hidden');
        // video_obj.src = '';
        $('#show_layer').val(0);
        $('#desc').hide();
        $('#map').show();
        $(".exhibitInfo").css('display','');
    }

    function vrJump(l){
        var url = $('#vr').val();
        window.location=url;
    }

    /*beacon触发 插入数据库*/
    function beaconCount(id,name,isRoad){
        $.ajax({
            url: api_url + 'api/exhibitNum/openid/'+openid+'/exhibitId/'+id+'/exhibitName/'+name+'/road/'+isRoad,
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: '',
            type: 'get',
            datatype: 'json',
            success: function (e) {

            }
        })
    }
</script>
<script  type="text/javascript">
    wx.config({!!  $config  !!});
</script>
<script type="text/javascript">

  B.timeout  = 60000;
  B.beaconTouchOn = function(){

      var neatBeacon  =  this.accpetBeaon.length > 0 ? this.accpetBeaon[0] : null;
      var debugInfo = B.findTriggerByMinor(B.initBeacons[0].minor)
      $('.bottom_exhibit').text('检测到信号，距离'+debugInfo.title+'还有'+B.initBeacons[0].accuracy+'米');


      if( !B.timer[neatBeacon.minor]  ){

        trigger(neatBeacon.mp3,neatBeacon.title,neatBeacon.id,neatBeacon.url);

          B.timeInBeacon(neatBeacon);
      }else if( B.timer[neatBeacon.minor] &&  parseInt( new Date().getTime()- B.timer[neatBeacon.minor].start ) > B.timeout  ){


          trigger(neatBeacon.mp3,neatBeacon.title,neatBeacon.id,neatBeacon.url);
          B.timeInBeacon(neatBeacon);
      }



  }




  B.ready(function(){

      var self = this;

      B.startSearchBeacons(function(argv){
              if (argv.errMsg == 'startSearchBeacons:ok') {
                  layer.open({
                      area: ['90%', 'auto'],
                      title: '沾化区博物馆',
                      content: '<div style="width: 100%"><span style="text-align:left">&nbsp;&nbsp;欢迎来到滨州市沾化区博物馆，靠近地图上所标识的展品后，将自动为您推送相应的讲解音频，您也可手动点击地图上的标识以收听音频并查看详情</span><br/><div style="padding-top:0.04rem;width: 100%;text-align: center;">友情提示：佩戴耳机收听效果更佳</div></div>'
                  })
                  ;
              } else if (argv.errMsg == 'startSearchBeacons:location service disable') {
                  layer.confirm('欢迎来到滨州市沾化区博物馆，请返回微信并启动手机蓝牙和位置服务（GPS）后，再进入智慧导览界面，即可体验靠近展板时自动播放讲解的智慧导览服务',{
                      area: ['90%', 'auto'],
                      btn: ['开蓝牙及GPS', '暂不开启'] //可以无限个按钮
                  }, function(index){
                      wx.closeWindow();
                  },function(index){
                  });
              }  else if (argv.errMsg == 'startSearchBeacons:bluetooth power off') {
                  layer.confirm('欢迎来到滨州市沾化区博物馆，请返回微信并启动手机蓝牙和位置服务（GPS）后，再进入智慧导览界面，即可体验靠近展板时自动播放讲解的智慧导览服务',{
                      area: ['90%', 'auto'],
                      btn: ['开蓝牙及GPS', '暂不开启'] //可以无限个按钮
                  }, function(index){
                      wx.closeWindow();
                  },function(index){
                  });

              }  else if (argv.errMsg == 'startSearchBeacons:system unsupported') {
                  layer.msg('系统不支持',{icon: 5})
              } else {

              }
          }
      );


      wx.onSearchBeacons({
          complete:function(argv){

              self.sortByDistance(argv);
              self.findIndex()

          }
      });

  }.bind(B))


    function trigger(mp3,title,id,vrUrl){
        music_back.play();
        music_obj.src = all_url + mp3;
        music_obj.play();

        var a = `.leaflet-marker-icon`;
        $(''+a).prop("src","/images/zhanhua/point_default.png");

        if (music_obj.paused) {
            $("#tab1").prop("src", "" + on);
        } else {
            $("#tab1").prop("src", "" + off);
        }
        var a = `.leaflet-marker-icon[title='marker${id}']`;
        $(''+a).prop("src","/images/zhanhua/point_sel.png");


        /*显示菜单*/
        $('#title').text(title);
        $('#vr').val(vrUrl);
        $(".hide1").css('visibility', 'visible');
        $(".exhibitInfo").addClass("slideInUp");
        $(".exhibitInfo").removeClass("slideOutDown");
        $(".desc").attr('id', id);
    }

    music_obj.onended=function(){
        $("#tab").prop("src", "" + on);
        $("#music11").prop("src",""+on);
    };
    video_obj.onplay = function(){
        music_obj.pause();
        $("#tab").prop("src", "" + on);
        $("#music11").prop("src",""+on);
    };
    video_obj.onpause = function(){
        music_obj.play();
        $("#tab").prop("src", "" + off);
        $("#music11").prop("src",""+off);
    };
     $('#F2').on('click',function(){
         $('#headimg').attr('src','/images/zhanhua/title.png');
         $('#id').val(13);
        $(".exhibitInfo").addClass("slideOutDown");
         music_obj.pause();
     });
     $('#F3').on('click',function(){
         $('#headimg').attr('src','/images/zhanhua/title_f3.png');
         $('#id').val(19);
         $(".exhibitInfo").addClass("slideOutDown");
          music_obj.pause();
     });

  (function() {
      $('.leaflet-control-layers').addClass('leaflet-control-layers-expanded').css({'padding':0});
      $('input[type=radio][name=leaflet-base-layers]').css({'display':'none'});
      var leafletBase = $('.leaflet-control-layers-base').css({'width':'30px','text-align':'center'}).find('label').css({'height':'30px','line-height':'30px'});
      leafletBase.on('click',function(){
          $(this).css({'color':'white','background-color':'#cf4e3a'}).siblings().css({'color':'#333333','background-color':'white'})
      });
      $('#F2').trigger('click');

      if (typeof WeixinJSBridge == "object" && typeof WeixinJSBridge.invoke == "function") {
          handleFontSize();
      } else {
          if (document.addEventListener) {
              document.addEventListener("WeixinJSBridgeReady", handleFontSize, false);
          } else if (document.attachEvent) {
              document.attachEvent("WeixinJSBridgeReady", handleFontSize);
              document.attachEvent("onWeixinJSBridgeReady", handleFontSize);  }
      }
      function handleFontSize() {
          // 设置网页字体为默认大小
          WeixinJSBridge.invoke('setFontSizeCallback', { 'fontSize' : 0 });
          // 重写设置网页字体大小的事件
          WeixinJSBridge.on('menu:setfont', function() {
              WeixinJSBridge.invoke('setFontSizeCallback', { 'fontSize' : 0 });
          });
      }
  })();

</script>
</body>
</html>
