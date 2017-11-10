<?php

namespace App\Http\Controllers\weixin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class JssdkController extends AuthController
{
	public  $js  = '';
	public  $app = ''; 

    public  function  __construct(){

    	$this->app  = $this->weixin();

    	$this->js = $this->app->js;

	}
}
