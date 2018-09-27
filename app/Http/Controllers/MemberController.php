<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Input;
use App\Clients;
use App\User;
use DB;


class MemberController extends Controller
{
     
	public function getAll(Request $request)
	    {
		$id=$request->input('client_id');
	    $members=DB::table('users')->select(['id','name','email','avatar'])->where('client_id',$id);
 		$client=Clients::find($id);
 		$data['client']=$client;
 		$data['members']=$members;
		// $resp = Datatables::of($members)->make(true);
            echo "<pre>request is :-";
            print_r($members);
            exit;
		$data = $resp->getData(true);
		// $data['key'] = 'value';
 		return response()->json($members);
		}

}
