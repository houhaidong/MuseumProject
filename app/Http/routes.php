<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//添加后台群组路由
Route::group(["prefix"=>"admin","namespace"=>"Admin","middleware"=>"loginAuth"],function(){

    //后台登陆首页
    Route::get("home","HomeController@index")->name("home");
    //显示展品
    Route::get("goods","GoodsController@show")->name("goods");
    //添加展品
    Route::get("addGoods","GoodsController@addGoods");
    //保存展品
    Route::post("store","GoodsController@store");
     //编辑展品
    Route::get("updateGood/{id}","GoodsController@updateGood")
     ->where(['id' => '[0-9]+']);
    //  编辑展品
     Route::post("editGood/{id}","GoodsController@editGood")
     ->where(['id' => '[0-9]+']);
     //删除展品
    Route::get("delGood/{id}","GoodsController@delGood")
    ->where(['id' => '[0-9]+']);


    //地图
    Route::get("map","MapController@show")->name("map");


    //显示路标
    Route::get("road","RoadController@show")->name("road");
    //添加路标
    Route::get("addRoad","RoadController@addRoad");
    //保存路标
    Route::post("roadStore","RoadController@roadStore");
    //编辑路标
    Route::get("updateRoad/{id}","RoadController@updateRoad")
        ->where(['id' => '[0-9]+']);
    //编辑路标
    Route::post("editRoad/{id}","RoadController@editRoad")
        ->where(['id' => '[0-9]+']);
    //删除路标
    Route::get("delRoad/{id}","RoadController@delRoad")
        ->where(['id' => '[0-9]+']);




    //删除按钮
    Route::get("delButton/{id}","ButtonController@delButton")
        ->where(['id' => '[0-9]+']);


    // -----------------------------------------------------------
    Route::get("exhibit/goods/{id}","ProjectController@goods")->name("admin.exhibit.goods")
    ->where(['id' => '[0-9]+']);

    Route::any("sort/edit","ProjectController@sorting_edit");

    // 添加展品到展览的显示模版
    Route::get("exhibit/addGoods/{id}","ProjectController@addGoods")->name("admin.exhibit.addGoods")
    ->where(['id' => '[0-9]+']);
    // 添加展品到展览的action动作
    Route::get("exhibit/actionRemoveGoods/{id}/{exhibit}","ProjectController@actionRemoveGoods")
    ->name("admin.exhibit.actionRemoveGoods")
    ->where(['id' => '[0-9]+'],['exhibit' => '[0-9]+']);

    // 移除展品到展览的action动作
    Route::get("exhibit/actionAddGoods/{id}/{exhibit}","ProjectController@actionAddGoods")
    ->name("admin.exhibit.actionAddGoods")
    ->where(['id' => '[0-9]+'],['exhibit' => '[0-9]+']);

    // 展览资源路由
    Route::resource("exhibit","ProjectController");

    // 点位资源路由
    Route::resource("poi","PoiController");

    //热力图第二页
    Route::resource("changMap","HomeController@changMap");

    // 用户配置资源路由
    Route::resource("config","ConfigController");

    // 用户统计资源路由
    Route::resource("statistics","StatisticsController");
    Route::any("visit","StatisticsController@visit");
    Route::any("ajaxVisit/starttime/{starttime}/endtime/{endtime}/exhibitid/{id}","StatisticsController@ajaxVisit");
    Route::any("ajaxTime/starttime/{starttime}/endtime/{endtime}/exhibitid/{id}","StatisticsController@ajaxTime");
    Route::any("ajaxLine/starttime/{starttime}/endtime/{endtime}","StatisticsController@ajaxLine");

    Route::any("line","StatisticsController@line");

    // 用户上传文件
    Route::any("uploader","BaseController@fileUploader");
    Route::any("videoUpload","BaseController@videoUpload");

    //云数据存储
    Route::get('cloud', "BaseController@resource_upload");



    // 设备管理相关
    Route::resource("device","DeviceController");


});


//添加前台群组路由
Route::group(["prefix"=>"index","namespace"=>"Index"],function(){

    Route::get("/","LoginController@login");

});

//添加前台群组路由
Route::group(["prefix"=>"api","namespace"=>"Api"],function(){

    Route::get("exhibitTime/openid/{openid}/exhibitId/{exhibitId}/exhibitName/{exhibitName}/startTime/{startTime}/endTime/{endTime}/road/{isRoad}","APiController@exhibitTime");
    Route::any("device","DeviceController@device");
      // 统计相关
    Route::get("exhibitNum/openid/{openid}/exhibitId/{exhibitId}/exhibitName/{exhibitName}/road/{isRoad}","APiController@exhibitNum");



    Route::get("API","APiController@API");

});


//载入登陆模板
Route::get("/admin","Admin\LoginController@login")->name("login");
//判断用户登陆规则
Route::post("/loginHandle","Admin\LoginController@loginHandle");
//判断用户登陆规则
Route::get("/loginout","Admin\LoginController@loginout");





// 默认首页
//Route::get("/","Index\IndexController@author");
Route::get("/","Index\IndexController@index");
Route::get("index_fjs","Index\IndexController@index_fjs");


Route::get("index/id/{id}","Index\IndexController@index");
//Route::get("author","Index\IndexController@author");
Route::get("authorCallback","Index\IndexController@authorCallback");
Route::get("/descript/pid/{pid}","Index\IndexController@descript");
Route::any("/exhibit","Index\IndexController@exhibit");
Route::any("/MapDetail/id/{id}","Index\IndexController@MapDetail");
Route::any("/MapList","Index\IndexController@MapList");
Route::any("/setCount/openid/{openid}/access_token/{access_token}/name/{name}/type/{type}/status/{status}","Index\IndexController@setCount");
Route::any("/getIbeacon","Index\IndexController@getIbeacon");






Route::get("/test",function(){


        echo "uuu";

});







