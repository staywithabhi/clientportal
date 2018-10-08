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
use App\Role;
use DB;
use Hash;
use Validator;
use Image;

class ClientController extends Controller
{

	public function assignRoles(Request $request)
	{
		$id =$request->input('id');
		$roles=$request->input('roles');
        $role_str = implode(",", array_keys($roles));
		// $role_str=$request->input('role_str');
		if($role_str=='readonly')
			$role_str='Read Only';
		if($role_str=='writeonly')
			$role_str='Write Only';
		if($role_str=='manager')
			$role_str='Manager';
		// echo $role_str;
		// exit;
		$user=User::find($id);
		$user->roles=$role_str;
		$user->save();
		$user->roles()->detach();
		
	    foreach($roles as $key=>$value)
	    {
	    	// echo $key;
	         $user->roles()->attach(Role::where('name', $key)->first());
	    }
	    // exit;
	    return response()->json("success");
	}
	public function imageUpload(Request $request)
	{
		// echo "abhishebvcbk";
		// exit;
		// $avatar = $request->file('avatar');
		// $filename = time() . '.' . $avatar->getClientOriginalExtension();
		// Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
		// return response()->json($request->file('avatar'));


		       $data =$request->all();


        // do we have an image to process?
        if($request->hasFile('avatar')){
        	$avatar =$request->file('avatar');

            //$filename = substr( md5( $student->id . '-' . time() ), 0, 15) . '.' . $request->file('image')->getClientOriginalExtension();
            $filename = $avatar->getClientOriginalName();

            $path = public_path('/uploads/avatars/' . $filename);
            //  echo "<pre> Image source is";
            //  print_r($request->avatar);
            // exit;
            // Image::make($request->file('avatar'))->orientate()->fit(500)->save($path);
    		Image::make($avatar)->save($path);


            // now update the photo column on the student record
            // $student->photo = $filename;
            // $student->save();
           $msg="saved successfully"; 
 			return response()->json($msg);
        }
        $msg="not saved successfully"; 
 			return response()->json($msg);

	}
    
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
