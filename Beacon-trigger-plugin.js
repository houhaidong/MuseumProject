;function(win,doc,undefined){

var Trigger = function(id,exhibit_title,exhibit_music,beacon_dis,exhibit_dis){
    this.exhibitObj = {};
    this.beacon_dis = parseFloat(beacon_dis);                         //becon的距离
    this.exhibit_dis = parseFloat(exhibit_dis);                       //展品后台的距离
    this.NowTime = Date.parse(new Date());                            //当前的时间
    this.beacon_start_time = '';                                      //开始时间
    this.beacon_end_time = '';                                        //结束时间
    this.exhibit_title = exhibit_title;                               //展品名称
    this.exhibit_mp3 = exhibit_music;                                 //展品音频

    this._Distance();

}
Trigger.prototype={
    constructor:Trigger,
    //判断距离
    _Distance = function(){
        var _self = this;
        if(this.beacon_dis <= this.exhibit_dis){

              this._trigger();
        }else{

        }
    },
    //触发
    _trigger = function(){
        layer.msg('您已经抵达' + this.title);
        this._triggerBox(this.mp3,this.id,this.title);

    },

    _triggerBox = function(mp3,id,title){
        music_back.play();
        music_obj.src = all_url + mp3;
        music_obj.play();
        if (music_obj.paused) {
            $("#tab").prop("src", "" + on);
        } else {
            $("#tab").prop("src", "" + off);
        }
        var a = `.leaflet-marker-icon[title='marker${id}']`;
        /*图片变大*/
        $(".leaflet-marker-icon").removeClass("exhibit-icon");
        $(".leaflet-marker-icon").removeClass("exhibit-iconIndex");


        $(''+a).addClass("exhibit-icon");


        $(''+a).addClass("exhibit-iconIndex");

        /*显示菜单*/
        $('h3').text(title);
        $(".hide1").css('visibility', 'visible');
        $(".exhibitInfo").addClass("slideInUp");
        $(".exhibitInfo").removeClass("slideOutDown");
        $(".desc").attr('id', id);

    }

}

}(window,document)



<div id="app" style="border: 1px solid red;width:100%;height:.35rem;position: relative">
    <div style="border: 1px solid green;width: 100%;height: .15rem;text-align: center">
        <img src="/images/zhanhua/vr.png" style="width: .2rem">
    </div>

    <input type="hidden" id="show_layer" value="0">
    <div style="border:1px  solid #666;width: 95%;height: 0.148rem;background-color: white;margin: 0 auto;display: flex;display: -webkit-flex;justify-content:space-between;border-radius: 3px;position: absolute;bottom: 0;left: 2%;">
        <div style="/*border:1px solid black;*/display: flex;display: -webkit-flex;justify-content:center;align-items:center">
            <img id="tab1" src="/images/zhanhua/off.png" style="width:0.11rem;margin-left: .02rem;" alt="" onclick="Musicstatus()">
            <span style="font-size:18px;;margin-right:.02rem;margin-left: .02rem">美学厅</span>
        </div>
        <div style="/*border: 1px solid yellow;*/display: flex;display: -webkit-flex;justify-content:flex-start;align-items:center;width: 30%;flex:auto">
            <div style="border: 1px solid #666;border-radius:3px;color: #666;font-size: 12px">  &nbsp;&nbsp;目前到达位置&nbsp;&nbsp;</div>
        </div>
        <div style="/*border: 1px solid blue*/;width:10%;display: flex;display: -webkit-flex;justify-content:center;align-items:center">
            <img src="/images/zhanhua/arrow.png" style="width: 0.03rem" />
        </div>
    </div>
    <audio  id="music" style="display: none;"></audio>
    <audio src="http://opun2zg3k.bkt.clouddn.com/backMusic.mp3" id="backmusic" style="display: none;"></audio>
</div>
