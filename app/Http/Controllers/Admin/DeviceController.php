<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\weixin\AuthController;




class DeviceController extends Controller
{
    public $app = '';
    public $access_token;

    public  function __construct(){

        $controller = new AuthController();
        $this->app = $controller->weixin();
//        $token = json_decode(\http_get('http://h.xiangminiao.com/index.php?g=Api&m=WxApi&a=get_access_token&token=lkrfei1460443834',''));
        $this->access_token = $this->app->access_token->getToken();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $url = "https://api.weixin.qq.com/shakearound/device/group/getlist?access_token=".$this->access_token;

       $result = json_decode(\http_post($url,array('begin'=>0,"count"=>1000)));


       p($result);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = "https://api.weixin.qq.com/shakearound/device/group/add?access_token=".$this->access_token;
        $result = \http_post($url,array("group_name" => "梵净山地质博物馆"));

        dd($result);




        return view("admin.device.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $url = "https://api.weixin.qq.com/shakearound/device/group/adddevice?access_token=".$this->access_token;



         $devices = [];

         for ($i=0; $i < 49; $i++) {
             $row = [
                 "device_id" =>16976233+$i,
                 "uuid" =>"FDA50693-A4E2-4FB1-AFCF-C6EB07647825",
                 "major" =>10173,
                 "minor" =>16720+$i
             ];
             $devices[] = $row ;
         }

        $data = [
            "group_id" => 3329671,
            "device_identifiers" => $devices
        ];

        $result = \http_post($url,$data);





        return view("admin.device.show",compact("result"));
       
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $url = "https://api.weixin.qq.com/shakearound/device/group/getdetail?access_token=".$this->access_token;
        $result = \http_post($url,array("group_id" => 3329671,"begin"=>0,"count"=>100));

        p($result);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
