<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
   
        $data = DB::table('users')->get();
      return $data;
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data = DB::table('users')->insert($data);
        return $data;
    }
    public function delete(Request $request)
    {
        $data = $request->all();
        $data = DB::table('users')->where('id', $data['id'])->delete();
        return $data;
    }
}
