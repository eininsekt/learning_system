<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

use Session;
use Requests;
use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Facades\Input;
use DB;
use App\users;

class ProfileController extends Controller
{
    //
   public function get(){
       if(Session::get('Login')=="True") {
           $username = Session::get('UserName');
           $sampuser = users::where('username', $username)->get();
           if (!$sampuser->isEmpty()) {
               foreach ($sampuser as $thisuser) {
                   $userinfo['phone'] = $thisuser->phone;
                   $userinfo['email'] = $thisuser->email;
                   $userinfo['phone'] = $thisuser->phone;
                   $userinfo['name'] = $thisuser->name;
                   $userinfo['type'] = $thisuser->type;
               }
               $userinfo['username'] = $username;
           }
           $courses = Course::all();
           return view('profile')->with(['info'=>$userinfo,'courses'=>$courses]);
       }
       else{
           return redirect('/UserArea');
       }
   }

    public function change(){
        //echo "salam";
        $username=Session::get('UserName');
        $request=Input::all();
        $update=DB::table('users')
            ->where('username',$username)
            ->update(['name' => $request['name'],'phone'=> $request['phone'],
                'email' => $request['email'], 'username'=>$request['username']
            ]);
        //$update=users::create(Input::all());
        if($update)
        {
            return redirect('/Profile');
        }
        else {
            return view('profile')->with('error',1);
        }
    }
    public function changepass(){
        //echo "salam";
        $username=Session::get('UserName');
        $request=Input::all();
        $update=DB::table('users')
            ->where('username',$username)
            ->update(['password' => $request['password']
            ]);
        //$update=users::create(Input::all());
        if($update)
        {
            return redirect('/Profile');
        }
        else {
            return view('profile')->with('error',1);
        }
    }
    
    public function check()
    {
        $count=0;
        $username=Session::get('UserName');
        $input1=Input::get('oldpass');
        $info=DB::select("select * from users where username=\"$username\" AND password=\"$input1\"");
        foreach($info as $i){
            $count++;
        }
        if($count) {echo 1;}
        else {
            echo 0;
        }
    }
}
