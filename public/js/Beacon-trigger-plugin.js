/*
;(function (window, document, undefined) {
    var exhibitObj = {};
    //var data = {};
    //var Trigger = function(id,exhibit_title,exhibit_music,beacon_dis,exhibit_dis){
    var Trigger = function(options){

       /!* this.data = this.extend({
            id:1111,

        },options);
        alert(this.data.id);*!/
        //var exhibitObj = {};
        //this.data = {};
        this.id = id;
        this.beacon_dis = parseFloat(beacon_dis);                         //becon的距离
        this.exhibit_dis = parseFloat(exhibit_dis);                       //展品后台的距离
        this.NowTime = '';                                                //当前的时间
        this.beacon_start_time = '';                                      //开始时间
        this.beacon_end_time = '';                                        //结束时间
        this.exhibit_title = exhibit_title;                               //展品名称
        this.exhibit_music = exhibit_music;                               //展品音频

        this._Distance();

    }
    Trigger.prototype={
        constructor:Trigger,
        //判断距离
        _Distance: function(){
            var _self = this;
            //在触发范围内
            if(this.beacon_dis <= this.exhibit_dis){

                //判断是不是第一次触发
                if(exhibitObj[this.id] == null || exhibitObj[this.id] == undefined){
                    this.NowTime = Date.parse(new Date());
                    exhibitObj[this.id] = {
                        id: this.id,
                        name: this.exhibit_title,
                        startTime:this.NowTime,
                        endTime:this.NowTime
                    };
                    //exhibitObj[this.id] = this.data;
                    //alert(exhibitObj[this.id].name);
                    this._trigger();
                }else{
                    //如果不是第一次触发，就更新结束时间
                    exhibitObj[this.id].endTime = Date.parse(new Date());

                }
            }else{
                //不在触发范围内

                var now = Date.parse(new Date());
                if(now - exhibitObj[this.id].endTime > limitTime){

                }
            }
        },
        //触发
        _trigger: function(){

            layer.msg('您已经抵达' + this.exhibit_title);
            this._triggerBox(this.mp3,this.id,this.title);

        },

        _triggerBox: function(){
            music_back.play();
            music_obj.src = 'http://fjs.test.passbookii.com/upload/' + this.exhibit_music;
            music_obj.play();
            if (music_obj.paused) {
                $("#tab").prop("src", "" + on);
            } else {
                $("#tab").prop("src", "" + off);
            }
            var a = `.leaflet-marker-icon[title='marker${this.id}']`;
            /!*图片变大*!/
            $(".leaflet-marker-icon").removeClass("exhibit-icon");
            $(".leaflet-marker-icon").removeClass("exhibit-iconIndex");


            $(''+a).addClass("exhibit-icon");


            $(''+a).addClass("exhibit-iconIndex");

            /!*显示菜单*!/
            $('h3').text(this.exhibit_title);
            $(".hide1").css('visibility', 'visible');
            $(".exhibitInfo").addClass("slideInUp");
            $(".exhibitInfo").removeClass("slideOutDown");
            $(".desc").attr('id', this.id);

        }
    }
    window.Trigger = Trigger;
})(window,document)
*/
;(function(window){

    function aprbrother (){
        this.trigger = "";
        this.timeout = 20000;
        this.current = null,
            this.timer  = {}

    }

    // 开启beacon周边
    aprbrother.prototype.startSearchBeacons = function (callback) {
        wx.startSearchBeacons({
            complete:callback
        })
    }

    function dump(obj){
        app = document.getElementById("app")
        app.innerHTML =  JSON.stringify(obj,null,"\t")
    }


    // 获取的beaon信息
    aprbrother.prototype.sortByDistance = function (argv) {

        var initBeacons = argv.beacons.filter(function (x) {
            return x.accuracy  > 0;
        });
        initBeacons.sort(function(a,b){
            return  parseFloat(a.accuracy) - parseFloat(b.accuracy);
        })
        this.initBeacons =  initBeacons
        return initBeacons;

    }

    // 获取的beaon信息    findTriggerByMinor
    aprbrother.prototype.findTriggerByMinor = function (minor) {
        for (var i = 0 ; i<this.trigger.length;i++){
            if(this.trigger[i].minor== minor){
                return this.trigger[i]
            }
        }

        return false;

    }

    aprbrother.prototype.timeInBeacon = function(beacon){
        // alert(beacon)
        var currentTime =  new Date().getTime();
        beacon.start =  currentTime
        var minor  = beacon.minor;
        this.timer[minor] = beacon;
    }

    // 符合触发范围的beaon
    aprbrother.prototype.findIndex = function(obj){
        var self =  this
        var  result = this.initBeacons.map(function(item,key,array){

            return _.find(self.trigger, function(chr) {
                return chr.minor == item.minor && parseFloat(chr.distance) > parseFloat(item.accuracy) ;
            });
        })

        var result = result.filter(function (x) {
            if(x){
                return true;
            }
        });
        this.accpetBeaon = result;
        this.beaconTouchOn()
    }

    // 触发beacon
    aprbrother.prototype.beaconTouchOn = function(){

    }


    aprbrother.prototype.stopSearchBeacons = function(callback){
        wx.stopSearchBeacons({
            complete:callback
        });
    }

    // 准备
    aprbrother.prototype.ready = function(callback){
        wx.ready(callback);
    }

    // export class instance
    window.B  =  new aprbrother();


})(window);