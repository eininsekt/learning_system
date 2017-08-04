<?php

namespace App\Http\Controllers;


use Request;
use Illuminate\Support\Facades\Input;
use Session;
use DB;

class DashboardController extends Controller
{
    //
    public function get(){
        if(Session::get('Login')!="True"){
            return redirect('/');
        }
        $username=Session::get('UserName');
        $users=DB::select('Select * From goal where username="'.$username."\"");
        $info=array();
        $info['exam']=2;
        $info['questions']=15;
        foreach ($users as $user){
            $info['exam']=$user->exam;
            $info['questions']=$user->questions;
        }
        return view('dashboard')->with(['info'=>$info]);
    }
    public function SetGoal(){
        $exams=(int) Input::get('exam');
        $questions=(int) Input::get('questions');
        $username=Session::get('UserName');
        $users=DB::select('select * from goal Where username="'.$username.'"');
        $check=0;
        foreach ($users as $user){
            $check=1;
            DB::table('goal')
                ->where('username',"$username")
                ->update(['exam'=>$exams,'questions'=>$questions]);
        }
        if(!$check){
            DB::table('goal')->insert(
              [
                  'username'=>$username,
                  'exam'=>$exams,
                  'questions'=>$questions
              ]
            );
        }
        return redirect('/Dashboard');
    }
}
