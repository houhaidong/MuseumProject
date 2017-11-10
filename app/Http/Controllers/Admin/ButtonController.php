<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class ButtonController extends Controller
{
    public function delButton($id)
    {
        $data = DB::table('menu')->where('id','=',$id)->delete();
        return json_encode($data,1);
    }
}