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
use DB;

class ClientController extends Controller
{
    
	public function getAll(Request $request)
	    {
			$clients= DB::table('clients')->get();
	        // $members=DB::table('client_members')->get();
	        // $members= new Members;
	        // echo "<pre>";
	        // print_r($clients);
	        // exit;

 			return response()->json($clients);

	    }
    	public function edit(Request $request)
	    {
			$id=$request->input('id');
			$client=Clients::find($id);
			return response()->json($client);

	    }
    	public function update(Request $request)
	    {



			$id=$request->input('id');
			if($id){

				$client=Clients::find($id);
				$client->title=$request->input('title');
	            $client->email=$request->input('email');
	            $client->save();

	            $flag=1;
	            
			}
			else
			{
				 $flag=0;
			}
			return response()->json($flag);

	    }
	    public function save(Request $request)
	    {
	    	$client= new Clients;
			if($request->input('title') && $request->input('email')){
				try {
					$client->title=$request->input('title');
		            $client->email=$request->input('email');
		            $client->save();
		            $flag=1;
				}
				  catch(\Illuminate\Database\QueryException $e){
				        $errorCode = $e->errorInfo[1];
				       // print_r($e->errorInfo);
				       // exit;
				        $flag=3;
				        if($errorCode == '1062'){
				            $flag=2;

		       			}
   					}

				return response()->json($flag);
	    	}
		}

		 public function destroy(Request $request)
	    {
	    	$id=$request->input('id');
	        $client=Clients::find($id);        
	        if($client){
	            $client->delete();
				$flag=1;
	        }
	        else{
				$flag=0;
	        }
			return response()->json($flag);
	    }


}
