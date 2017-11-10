@extends("layouts.admin")

@section("section")

    <div class="main-container">
        <div class="container-fluid">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-md-7">
                        <div class="page-breadcrumb-wrap">

                            <div class="page-breadcrumb-info">
                                <h2 class="breadcrumb-titles"> Web Application Backend</h2>
                                <ul class="list-page-breadcrumb">
                                    <li><a href="#">Home</a>
                                    </li>
                                    <li class="active-page">热力图</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="map" style="width: 100%;height:500px;border: 1px solid #bdbdbd;margin: 0 auto;"></div>
            </div>
            <div style="width: 100%;height: 30px;text-align: center;margin-top: 15px;">
                <div style="margin: 0 auto;" class="pagination">
                    <li>
                        <span><a href="{{asset('admin/home')}}">二层</a></span>
                    </li>
                    <li class="active">
                        <span>三层</span>
                    </li>
                </div>
            </div>
        </div>

    </div>
    </div>

@endsection

@section('js')
    <script>
        var a = '<?php echo json_encode($data);?>';
        var data1 = eval(a);
        console.log(data1)
        var imageUrl = "{{asset('map/3f.png')}}";
        var img = new Image();
        img.src = imageUrl;
        img.onload=function(){
            imgWidth = img.width;
            imgHeight = img.height;
            options = [];
            data1.forEach(function(item){
                var option = {
                    lat:item.lat,
                    lng:item.lng,
                    count:item.num
                }
                options.push(option);
            })

            var testData = {
                max: 100,
                data:options
                //data:[{lat: 0, lng:0,count:0},{lat:200, lng:200, count: 0},{lat:100, lng:100, count: 0}]
            };
            console.log(testData.data);
            var baseLayer = L.imageOverlay(imageUrl,[[-(imgHeight/2),-(imgWidth/2)],[imgHeight/2,imgWidth/2]],opacity=1);
            var cfg = {

                "radius": 100,
                "maxOpacity": .8,

                "scaleRadius": true,

                "useLocalExtrema": true,

                latField: 'lat',

                lngField: 'lng',

                valueField: 'count'
            };
            var heatmapLayer = new HeatmapOverlay(cfg);

            var map = new L.Map('map', {
                // 修改坐标系
                crs : L.CRS.Simple,
//            zoomControl:false,
                // 设置最大拖动边界
                maxBounds :[[-(imgHeight/2),-(imgWidth/2)],[(imgHeight/2),(imgWidth/2)]],
                // 设置缩放的最小值
                minZoom : -2,
                // 设置地图放大的最大值W
                maxZoom : -0.1,
                //设置初始化的缩放值
                zoom:-1.5,
                //设置地图中心点
                center:[0,0],
                //center: new L.LatLng(25.6586, -80.3568),
                //zoom: 2,
                layers: [baseLayer, heatmapLayer]
            });

            heatmapLayer.setData(testData);
//        L.marker([10, 10]).addTo(map);
        }


    </script>


@endsection