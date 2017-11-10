<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class APiController extends Controller
{
	/*展品停留时间*/
    public  function exhibitTime($oid,$eid,$ename,$sTime,$eTime,$road)
	{
		$eTime = $eTime/1000;
		$sTime = $sTime/1000;
		$exhibitTime = $eTime - $sTime;
		$data = [
			'openid' => $oid,
			'exhibitId' => $eid,
			'exhibitName' => $ename,
			'startTime' => $sTime,
			'endTime' => $eTime,
			'exhibitTime' => $exhibitTime,
			'isRoad' => $road,
			'creatTime' => date('Y-m-d H:i:s',time())
		];
		DB::table('statistics') -> insert($data);
	}

	public  function exhibitNum($oid,$eid,$ename,$road)
	{
		$data = [
			'openid' => $oid,
			'exhibitId' => $eid,
			'exhibitName' => $ename,
			'isRoad' => $road,
			'creatTime' => date('Y-m-d H:i:s',time())
		];

		$status = DB::table('count') -> insert($data);
		if($status){
			$code = 1;
		}else{
			$code = 0;
		}
		return json_decode($data['code'] = $code);

	}

	public function API()
	{

		$a = DB::table('statistics')->orderBy('id','desc')->get();
		$arr=[];
		foreach($a as $k => $v){
			$arr[$k]['id'] = $v->id;
			$arr[$k]['exhibitId'] = $v -> exhibitId;
			$arr[$k]['exhibitName'] =$v -> exhibitName;
			$arr[$k]['startTime'] = date("Y-m-d H:i:s",$v ->startTime);
			$arr[$k]['endTime'] = date("Y-m-d H:i:s",$v -> endTime);
			$arr[$k]['duration'] = $v ->exhibitTime;
		}
		return json_encode($arr,1);
	}

}
