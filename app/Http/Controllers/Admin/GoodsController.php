<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\admin\Exhibit;
use App\model\admin\Device;
use App\model\admin\Poi;
use App\model\admin\Resource;
use App\Http\Requests\addExhibit;
use DB;


class GoodsController extends Controller
{
    

    // 显示展品
    public  function show(){

        $data = DB::table('exhibit as e')
                ->leftJoin('project as p','p.id','=','e.map')
                ->select('e.title','e.id','e.map','p.pname')
                ->where('e.isRoad','<>','1')
                ->orderBy('id','desc')
                ->paginate(10);
        return view("admin.goods.show",compact('data'));
    }

    // 添加展览品
    public  function addGoods(){

        $project = DB::table('project') ->get();

        return view("admin.goods.add",compact('project'));
    }

    // 删除展品
    public function delGood( Request $request, Exhibit  $id){

        // 删除resource
        Resource::where("exhibit_id",$id->id)->delete();
        // 删除Device
        Device::destroy($id->id);
        // 删除poi
        Poi::where("exhibit_id",$id->id)->delete();
        // 删除展品
         $id->delete();

        return redirect()->route("goods");
    }
    

    // 编辑展品
    public function updateGood(Request $request,$id){

        $data = Exhibit :: where('id',$id)->first();

        $menu = DB::table('menu')->where('exhibitId','=',$id)->get();

        if($menu){
            if(isset($menu[0]->menuImg) && $menu[0]->menuImg == ''){
                $menu[0]->menuImg = null;
            }
            if(isset($menu[1]->menuImg) && $menu[1]->menuImg == ''){
                $menu[1]->menuImg = null;
            }
        }


        $prompt = DB::table('prompt')->where('exhibitId','=',$id)->get();
        foreach($prompt as $v){
           $v->content1 = str_replace("\r\n","&H",$v->content);
        }

        $pic = $data->resource()->where('type',1)->first();
        $music = $data->resource()->where('type',2)->first();
        $device = $data->device()->first();
        $project = DB::table('project') ->get();

        return view('admin/goods/update',compact('data',"pic","music","device",'menu','prompt','project'));
    }

    // 编辑展品

    public function editGood(addExhibit $request,$id){

//dd($request);

        $exhibit_id = Exhibit::where("id",$id)
                    ->update([
                        "title" => $request->title,
                        "content" => $request->content,
                        "map" => $request->map,
                        "project_id"=>$request->map,
                        'url' => $request->ARURL,
//                        "shop_url" => $request->shop_url,
                        "poster" => $request->hb,
                        "video_url" => $request->video
                        ]
                    );


        Resource::where([
                 ["exhibit_id","=",$id],
                 ["type","=",1]
            ])->update(
                [
                "resource_name"  =>   $request->pic,
                ]
            );

             Resource::where([
                 ["exhibit_id","=",$id],
                 ["type","=",2]
             ])
            ->update(
                [
                "resource_name"  =>   $request->music,
                ]
            );

         Device::where("exhibit_id",$id)
                        ->update([
                                "uuid"    =>   $request->uuid,
                                "major"   =>   $request->major,
                                "minor"   =>   $request->minor,
                            "distance"  =>   $request->distance,
                        ]);
          return  redirect()->route('goods');
    }


    // 保存展品

    public function store(addExhibit $request){
//dd($request);
        $exhibit_id = Exhibit::create([
            "title" => $request->title,
            "content" => $request->content,
            "user_id" => session("uid"),
            "map" => $request->map,
            "poster"  => $request->hb,
            "video_url" => $request->audio,
            'url' => $request->ARURL
            ]
        )->id;


        Resource::insert([
            [
             "resource_name"  =>   $request->pic,
                "exhibit_id"  => $exhibit_id,
                      "type"  =>  1 ,
                      "created_at" => date("Y-m-d H:i:s",time()),
                      "updated_at" => date("Y-m-d H:i:s",time())
                      
              ],
              [
             "resource_name"  =>   $request->music,
                "exhibit_id"  => $exhibit_id,
                      "type"  =>  2,
                      "created_at" => date("Y-m-d H:i:s",time()),
                      "updated_at" => date("Y-m-d H:i:s",time())
              ]
        ]);

         Device::create([
                "uuid"    =>   $request->uuid,
                "major"   =>   $request->major,
                "minor"   =>   $request->minor,
              "distance"  =>   $request->distance,
                "exhibit_id"  => $exhibit_id,
                     
          ]);
        $da = Exhibit::find($exhibit_id);
        $da -> project_id = $request->map;
        $da->save();
          return  redirect()->route("goods");
    }



}
