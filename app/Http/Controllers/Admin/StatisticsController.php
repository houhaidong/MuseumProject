<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    /**
     * 平均停留时间
     *
     *
     */
    public function index()
    {
        /*查询展品*/
        $data = DB::table('exhibit')
            ->select('id','title')
            ->where('isRoad','=',0)
            ->get();
        /*默认显示昨天的前十名*/
        $str = "select s.exhibitId,s.exhibitName,s.co,s.su,FORMAT(s.su/s.co,0) as num from";
        $str .= " (select *,count(exhibitId) as co,sum(exhibitTime) as su from statistics where isRoad = 0  GROUP BY exhibitId) as s ";
        $str .= " ORDER BY num desc  LIMIT 0,10";
        $sum = DB::select($str);
        //每个时间加60
        foreach($sum as $k){
            $k->num = $k->num + 60;
        }
        return  view("admin.statistics.index",['data'=>$data,'exhibit'=>$sum]);
    }

    /*
     *  平均停留时间筛选
     */
    public function ajaxTime($starttime,$endtime,$id)
    {
        $str = "select s.exhibitId,s.exhibitName,s.co,s.su,FORMAT(s.su/s.co,0) as num from";
        $str .= " (select *,count(exhibitId) as co,sum(exhibitTime) as su from statistics where isRoad = 0";
        $str .= " AND creatTime > '".$starttime."'";
        $str .= " AND creatTime < '".$endtime ."'";
        $str .= " AND exhibitId in (".$id.")";
        $str .= "  GROUP BY exhibitId) as s ";
        $str .= " ORDER BY num desc  LIMIT 0,10";

        $sum = DB::select($str);
        //每个时间加60
        foreach($sum as $k){
            $k->num = $k->num + 60;
        }
        return json_encode($sum,1);
    }

    /**
     *展品参观人次
     */
    public function visit()
    {
        /*查询展品*/
        $data = DB::table('exhibit')
            ->select('id','title')
            ->where('isRoad','=',0)
            ->get();
        /*默认显示昨天的前十名*/
        $exhibit = DB::select('select *,count(exhibitId) as num FROM `count` where isRoad = 0  GROUP BY exhibitId ORDER BY num DESC LIMIT 0,10');

        return   view("admin.statistics.visit",['data'=>$data,'exhibit'=>$exhibit]);
    }

    /*
     *展品参观人次   筛选
     */
    public function ajaxVisit($starttime,$endtime,$id)
    {

        $str = "select *,count(exhibitId) as num FROM `count` WHERE ";
        $str .= " creatTime > '".$starttime."'";
        $str .= " AND creatTime < '".$endtime ."'";
        $str .= " AND exhibitId in (".$id.")";
        $str .= " AND isRoad = 0 ";
        $str .= " GROUP BY exhibitId ORDER BY num DESC LIMIT 0,10";
        $data = DB::select($str);
        return json_encode($data,1);
    }


    /**
     *游客参观路线
     */
    public function line()
    {
        $str = "select e.id,e.title,s.openId,s.exhibitId,s.exhibitName,s.num from exhibit as e ";
        $str .= " LEFT JOIN (select openId,exhibitId,exhibitName,count(a.exhibitId) as num ";
        $str .= " from (select *,count(id) from `count` GROUP BY exhibitId,openid) as a  GROUP BY exhibitId) as s  ";
        $str .= " on s.exhibitId = e.id  where isRoad = 0 ORDER BY e.id DESC";
        $data = DB::select($str);
        //dd($s);
        foreach($data as $k){
            if($k->num == null){
                $k->num = 0;
            }
        }
        return   view("admin.statistics.line",['data'=>$data]);
    }

    /*
     * 参观路线 筛选
     */
    public function ajaxLine($starttime,$endtime)
    {
        $str = "select e.id,e.title,s.openId,s.exhibitId,s.exhibitName,s.num from exhibit as e ";
        $str .= " LEFT JOIN (select openId,exhibitId,exhibitName,creatTime,count(a.exhibitId) as num ";
        $str .= " from (select *,count(id) from `count` where creatTime > '".$starttime."' and creatTime < '".$endtime."'";
        $str .= " GROUP BY exhibitId,openid) as a  GROUP BY exhibitId) as s  ";
        $str .= " on s.exhibitId = e.id  where isRoad = 0 ";
//        $str .= " and s.creatTime > '".$starttime."' ";
//        $str .= " and s.creatTime < '".$endtime."'";
        $str .= "  ORDER BY e.id DESC";
        $data = DB::select($str);

        foreach($data as $k){
            if($k->num == null){
                $k->num = 0;
            }
        }

        return json_encode($data,1);
    }

}
