<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Hash;
use Image;
class UserController extends Controller
{
    //
    public function profile(){
        return view('profile',array('user'=>Auth::user()));

    }
    public function update_profile(Request $request){

        //handle user uploads and other data for profile
                // Handle the user upload of avatar
                $user = Auth::user();
    	if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $user->avatar = $filename;
        }
        if($request->input('name'))
        {
            $name = $request->input('name');
            $user->name= $name;
        }
        // $password = ;
        if($request->input('password')){
        $hashed = Hash::make($request->input('password'));
        $user->password= $hashed;
        }
        $user->save();
    	return view('profile', array('user' => Auth::user()) );

        
    }
}
