<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\admin\Poi;
use App\model\admin\Project;
use App\model\admin\Exhibit;
use App\model\admin\Device;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\weixin\JssdkController;

class IndexController extends BaseController
{

	//授权
	public function author(){
		$app = new JssdkController();
		$config = $app->app->config;
		$appid = $config->app_id;
		$redirect_uri = ENV('APP_URL').'authorCallback';
		$redirect_uri = urlencode($redirect_uri);
		$scope = 'snsapi_base';
		$str = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code";
		$str .= "&scope=".$scope."&state=123#wechat_redirect";
		header("Location:".$str);

	}
	//授权回调
	public function authorCallback()
	{
		$code = $_GET['code'];
		$app = new JssdkController();
		$config = $app->app->config;
		$appid = $config->app_id;
		$secret = $config->secret;
		$str = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code";
		$data = \http_post($str,'');
		$data = json_decode($data,1);
		$url = ENV('APP_URL').'index/id/'.$data['openid'];
		header("Location:".$url);

	}

//	public function index($id)
	public function index()
	{
//		$openid = $id;
		// 实例化jssdk
		$app = new JssdkController();
		$config = $app->js->config([
			"startSearchBeacons",
			"stopSearchBeacons",
			"onSearchBeacons",
			"onMenuShareAppMessage",
			"onMenuShareTimeline",
			"closeWindow"
		],false);


//dd($config);

//		return   view("index.index.index",compact("config"),['data'=>$openid]);
		return   view("index.index.index",compact("config"));

	}

	public function index_fjs()
	{
		$app = new JssdkController();
		$config = $app->js->config([
			"startSearchBeacons",
			"stopSearchBeacons",
			"onSearchBeacons",
			"onMenuShareAppMessage",
			"onMenuShareTimeline",
			"closeWindow"
		],false);

		return   view("index.index.index_fjs",compact("config"));
	}

	  //展品id获取展品详情
	  public function  descript($pid){
		  header('Access-Control-Allow-Origin: *');
		  $exhibit = DB::table('exhibit')
			  ->where("id",$pid)
			  ->first();

	  		return  view("index.index.descript",['data'=>$exhibit]);
	  }

	//根据展览id获取展品
	public function exhibit(){
		header('Access-Control-Allow-Origin: *');
		//var_dump($pid);
		$exhibit = DB::table('poi as p')
			->leftJoin('exhibit as e', 'e.id', '=', 'p.exhibit_id')
			->leftJoin('resource as r', 'p.exhibit_id', '=', 'r.exhibit_id')
			->leftJoin('device as d','p.exhibit_id','=','d.exhibit_id')
			->select('e.id','e.title','e.isRoad','e.project_id','e.url','p.coordinate','r.resource_name','d.uuid','d.major','d.minor','d.distance')
			->where("r.type",1)
//			->where("e.project_id",$pid)
		    ->orderBy("id","asc")
			->get();

		$exhibit2 = DB::table('poi as p')
			->leftJoin('resource as r', 'p.exhibit_id', '=', 'r.exhibit_id')
			->leftJoin('exhibit as e', 'e.id', '=', 'p.exhibit_id')
			->select('e.id','e.title','e.isRoad','p.coordinate','r.resource_name')
			->where("r.type",2)
//			->where("e.project_id",$pid)
		    ->orderBy("id","asc")
			->get();

		$num = count($exhibit);
		for($i=0;$i<$num;$i++){
			if($exhibit[$i]->id == $exhibit2[$i]->id){
				$exhibit[$i]->mp3 = $exhibit2[$i]->resource_name;
			}

		}

		foreach($exhibit as $v => $k){
			if($exhibit[$v]->coordinate !=='' && $exhibit[$v]->coordinate !== NULl){
				$num = explode(',',$exhibit[$v]->coordinate );
				$exhibit[$v]->x = (int)$num[0];
				$exhibit[$v]->y = (int)$num[1];
			}else{
 				$exhibit[$v]->x = (int)-9999999;
				$exhibit[$v]->y = (int)-9999999;
			}
		}
		return json_encode($exhibit,1);

	}

	/*获取地图上的坐标和名称*/
	/*public function MapList()
	{
		header('Access-Control-Allow-Origin: *');
		$exhibit = DB::table('exhibit as e')
			->leftJoin('poi as p', 'e.id', '=', 'p.exhibit_id')
			->select('e.id','e.title','p.coordinate')
			->get();

		$arr = [];
		$data = [];
		foreach($exhibit as $v => $k){
			if($exhibit[$v]->coordinate !=='' && $exhibit[$v]->coordinate !== NULl){
				$num = explode(',',$exhibit[$v]->coordinate );
				$postion[0] = (int)$num[0];
				$postion[1] = (int)$num[1];
				$arr[$v]['name'] = $k->title;
				$arr[$v]['id'] = $k->id;
				$arr[$v]['postion'] = $postion;
			}else{
				$ar[$v][0] = (int)-9999999;
				$ar[$v][1] = (int)-9999999;
			}

		}
		$markers['markers'] = $arr;
		$a = json_encode($markers,JSON_UNESCAPED_UNICODE);
		echo $a;
	}*/

	/*根据展品id获取展品的详情*/
	public function MapDetail($id)
	{
		header('Access-Control-Allow-Origin: *');
		$exhibit = DB::table('exhibit')
			->select('id','title','content','project_id','poster','video_url','isRoad')
			->where("id",$id)
			->first();

		return json_encode($exhibit,1);
	}

}
