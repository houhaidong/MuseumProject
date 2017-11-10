<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    //用户首页
    public function  index (){

        $str = "select e.id,e.title,s.num,p.coordinate from poi as p LEFT JOIN  exhibit as e  on p.exhibit_id = e.id ";
        $str .= "  LEFT JOIN (select exhibitId,exhibitName,count(exhibitId) as num from `count` GROUP BY exhibitId) as s ";
        $str .= " ON p.exhibit_id= s.exhibitId where p.project_id = 13";
        $num = DB::select($str);
        foreach($num as $k){
            $coordinate = explode(',',$k->coordinate );
            if($k->num == null){
                $k->num = 0;
            }
            $k->lat = (int)$coordinate[0];
            $k->lng = (int)$coordinate[1];
            /*$k->count = $k->num;*/
        }
        return view ("admin.home",['data'=>$num]);

    }

    /*热力图第二页控制器*/
    public function changMap()
    {
        $str = "select e.id,e.title,s.num,p.coordinate from poi as p LEFT JOIN  exhibit as e  on p.exhibit_id = e.id ";
        $str .= "  LEFT JOIN (select exhibitId,exhibitName,count(exhibitId) as num from `count` GROUP BY exhibitId) as s ";
        $str .= " ON p.exhibit_id= s.exhibitId where p.project_id = 19";
        $num = DB::select($str);
        foreach($num as $k){
            $coordinate = explode(',',$k->coordinate );
            if($k->num == null){
                $k->num = 0;
            }
            $k->lat = (int)$coordinate[0];
            $k->lng = (int)$coordinate[1];
            /*$k->count = $k->num;*/
        }

        return view ("admin.ChangMapController",['data'=>$num]);
    }
}
