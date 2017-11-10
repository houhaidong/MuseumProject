<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;


class AuthController extends Controller
{
    protected  $option =  [
		    'debug'  => true,
		    'app_id' => 'wx076f83f0320d7219',
		    'secret' => '5b40c1d24d4a93e712d1f2a71afacea0',
		    'token'  => 'a788bed18476c5081cfa3bdde7905fd2',
		    'log' => [
		        'level' => 'debug',
		        'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
		    ],
		];

    public   function  weixin(){
		return  new Application($this->option);
    }
}
