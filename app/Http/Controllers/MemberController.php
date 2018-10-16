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
use Auth;
use DB;
use App\Role;
use Hash;
use Validator;
use Image;


class MemberController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

	public function index(Request $request,Builder $htmlbuilder)
	{
		// echo "hello world";
		$client_id = Auth::user()->client_id;
		$clientObject=Clients::find($client_id);
		$clienttitle = $clientObject->title;

		if($request->ajax())
        {
			$members=DB::table('users')->select(['id','name','email','usertype','avatar'])
			->where('client_id',$client_id)
			// ->Where('roles', '!=', 'manager')
			->get();
			return Datatables::of($members)
            ->addColumn('action', function($row) {
                return '<a href="/member/edit/'. $row->id .'" class="btn btn-primary">Edit</a>
                <a data-href="/member/delete/'. $row->id .'" class="btn btn-danger" title="Delete" data-toggle="modal" data-target="#confirm-delete">Delete</a>';
            })
            ->make(true);
        }
        $html= $htmlbuilder
        // ->addColumn(['data'=>'id','name'=>'id','title'=>'Id'])
        ->addColumn(['data'=>'name','name'=>'name','title'=>'Name'])
        ->addColumn(['data'=>'email','name'=>'email','title'=>'Email'])
        ->addColumn(['data'=>'usertype','name'=>'usertype','title'=>'User Type'])
        ->addColumn([
            // 'defaultContent' => '',
            'data'=>'avatar',
            'name'=>'avatar',
            'title'=>'Avatar',
            'render' => '"<img src=\"/uploads/avatars/"+data+"\" width=\"50\"/>"',
            'orderable'      => false,
            'searchable'     => false,
            'exportable'     => false,
            'printable'      => true,
            'footer'         => '',
            ])
        ->addColumn([
            'defaultContent' => '',
            'data'           => 'action',
            'name'           => 'delete',
            'title'          => 'Actions',
            'render'         => null,
            'orderable'      => false,
            'searchable'     => false,
            'exportable'     => false,
            'printable'      => true,
            'footer'         => '',
        ]);
        return view('members.memberslist')->with(compact('html','clienttitle'));
    

	}
	 

	public function addMemberToClient()
    {
        return view('members.addMember');
    }

    public function saveMemberToClient(Request $request)
    {
 
		$member= new User;
		$client_id = Auth::user()->client_id;
       
        try {
        if($request->input('name'))
        {
            $name = $request->input('name');
            $member->name= $name;
        }
        if($request->input('email'))
        {
            $email = $request->input('email');
            $member->email= $email;
        }
        // if($request->input('client_id'))
        // {
        //     $client_id = $request->input('client_id');
        //     $member->client_id= $client_id;
        // }
        if($request->input('password')){
            $hashed = Hash::make($request->input('password'));
            $member->password= $hashed;
            }
        if($request->input('remember_token'))
        {
            $remember_token = $request->input('remember_token');
            $member->remember_token= $remember_token;
		}
        if($request->input('usertype'))
        {
            $usertype = $request->input('usertype');
            $member->usertype= $usertype;
        }


        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300,function($constraint)
            {
                $constraint->aspectRatio();
            })->save( public_path('/uploads/avatars/' . $filename ) );
            $member->avatar = $filename;

		}
		            // $client_id = $request->input('client_id');
            $member->client_id= $client_id;
        
        $member->save();
        $mem_id=$member->id;
        // $id =$request->input('id');
        $roles=$request->input('roles');
        $user=User::find($mem_id);
         // $roles=$request->input('roles');
      if(count($roles)>0)
        {
            $user->roles()->detach();
        
            foreach($roles as $key=>$value)
            {
                // echo $key;
                 $user->roles()->attach(Role::where('name', $key)->first());
            }
        }
        $request->session()->flash('alert-success', 'Member was added successfully!');

    }
    catch(\Illuminate\Database\QueryException $e){
        // echo "<pre>";
        // print_r($e->errorInfo);
        // exit;

        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            $request->session()->flash('alert-danger', 'Another record with same email already exists');

        }
    }
        // return redirect()->action('MemberController@index')->with('');
        return redirect()->route('manageMembers');
        // {{ route('manage', ['id' => $client->id]) }}
    }


	public function edit($id)
    {
        $member=User::find($id);
      
        if($member){

            return view('members.editmember')->with('member',$member);  
        }
        else{
         
            $msg ='Sorry, Member can not be found';
            $type='warning';
   return redirect()->back()->with($type,$msg);
        }
    }

     public function update($id,Request $request)
    {
        // echo "abhios";
        // exit;
        $rules=array(
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        
        // 'password' => 'required|min:6|confirmed',
        // 'accept_terms' => 'required|accepted',
        );
        $validator=Validator::make(Input::all(),$rules);
        $this->validate($request, ['name'=>'required']);
        if($validator->fails()){
            return redirect('memberEdit/'.$id)->withErrors($validator)->withInput();
        }
        else{

            $member=User::find($id);
            $member->name=Input::get('name');
            $member->email=Input::get('email');
         	 if($request->input('client_id'))
		    {
	            $client_id = $request->input('client_id');
	            $member->client_id= $client_id;
      		  }
            if(Input::get('password')){
                $hashed = Hash::make(Input::get('password'));
                $member->password= $hashed;
                // $user->password=Input::get('email')
			}
        if($request->input('usertype'))
        {
            $usertype = $request->input('usertype');
            $member->usertype= $usertype;
        }
             if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
                $member->avatar = $filename;
                // echo $clients;
                // exit;
            }

            $member->save();
            // $mem_id=$member->id;
        $roles=$request->input('roles');
        // $user=User::find($mem_id);
         // $roles=$request->input('roles');
      if(count($roles)>0)
        {
            $member->roles()->detach();
        
            foreach($roles as $key=>$value)
            {
                // echo $key;
                 $member->roles()->attach(Role::where('name', $key)->first());
            }
        }

            
            // $user->roles()->attach($role_user);

            $request->session()->flash('alert-success', 'User was updated successfully!');
 return redirect()->route('manageMembers');

        }
        # code...
    }



    public function destroy($id)
    {
        $member=User::find($id);
        if($member){
            $member->delete();
           $msg ='Member deleted successfully';
           $type='success';
        }
        else{
            $msg ='Sorry, Member can not be found';
            $type='warning';
        }
        // return redirect()->action('MemberController@index')
        //                 ->with($type,$msg);
     // return   Redirect::back();
        return redirect()->back()->with($type,$msg);

    }










}
