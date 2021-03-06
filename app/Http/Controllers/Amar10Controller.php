<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\Score;
use App\Section;
use App\User;
use App\School;
use App\Classes;
use App\Course;
use App\Question;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use App\tempanswer;

class Amar10Controller extends Controller
{
    //create class
    public function index() {
        $classname = Input::get('classname');
        $school_id = Input::get('school');
        $class = Classes::where('name',$classname)->where('school_id',$school_id)->first();

        if($class){
            $class = new classes();
            $class->name = $classname;
            $class->school_id = $school_id;
            $class->Rstring=Input::get('join_code');
            $class->save();

        }
        else{
            $class = new classes();
            $class->name = $classname;
            $class->school_id = $school_id;
            $class->Rstring=Input::get('join_code');
            $class->save();
        }

        return redirect('/TDashboard');
    }

    //add course to database
    public function addcourse(Request $request) {

        $coursename = Input::get('coursename');
        $grade = Input::get('grade');
        $email = Session::get('Email');
        $teacher = User::where('email','=',$email)->first();
        $upload = $request->file('image');

        if($upload) {
            $rand = rand(11, 99);
            $upload->move(public_path() . '/uploads', $rand . $upload->getClientOriginalName());
            $mim = $upload->getClientMimeType();
            $type_name = explode('/',$mim);
            $type_name = end($type_name);
            if ($type_name == 'jpg' || 'jpeg' || 'png') {
                $image_path = $rand . $upload->getClientOriginalName();
            }
        }
        $check = Course::where('name',$coursename)
            ->where('grade_id',$grade)
            ->where('teacher_name',$teacher->name)->first();

        if($check){
            $section = new Section();
            $section->course_id = $check->id;
            $section->name = Input::get('section');
            $section->save();
        }
        else {
            if ($coursename) {

                $course = new Course();
                $course->name = $coursename;
                $course->grade_id = $grade;
                $course->teacher_name = $teacher->name;
                $course->image = $image_path;
                $course->save();

                $course_id = Course::where('name', '=', $coursename)->where('grade_id',$grade)->first();
                $section = new Section();
                $section->course_id = $course_id->id;
                $section->name = Input::get('section');
                $section->save();
            }
        }

        return redirect('/TDashboard');
    }


    public function get($id){
        $check=0;
        if(Session::get('Login')=="True")
        {
            $email= Session::get('Email');
            $user = User::where('email','=',$email)->first();

            $course = Course::find($id);
            $users = $course->users;

            if(count($users) > 0) {
                foreach ($users as $u) {
                    if ($u->id == $user->id)
                        $check = 1;
                }
            }
        }else{
            $user = [];
        }
        $courses = Course::all();
        $course = Course::where('id','=',$id)->first();
        $count_solved = 0;
        $exercises = Exercise::where('course_id',$id)->get();
        foreach($exercises as $exercise){
            if($exercise->status == 2){
                $count_solved ++;
            }
        }
        $sections = Section::where('course_id',$id)->get();

        return view('amar10')->with(['Check'=>$check,'courses'=>$courses,'user'=>$user,'course'=>$course,'exercises'=>$exercises,
        'count_solved'=>$count_solved,'sections'=>$sections]);
    }

    public function quest($name){
        $count=2;
        $question_array=array();
        $questions=DB::select('select * from questions ORDER by RAND() LIMIT '."$count");
        $number=0;
        foreach ($questions as $question)
        {
            $question_array[$number]['id']=$question->id;
            $question_array[$number]['content']=$question->content;
            $question_array[$number]['answer']=$question->answer;
            $answers=explode(';',$question->answers);
            //print_r($answers);
            for($i=0;$i<=3;$i++){
                $question_array[$number]['answers'][$i]=$answers[$i];
            }
            switch ($question->level)
            {
                case 0 : $question_array[$number]['level']="ساده";
                    break;
                case 1:  $question_array[$number]['level']="متوسط";
                    break;
                case 2:  $question_array[$number]['level']="سخت";
                    break;
            }
            $number++;
        }
        return view('Q'.$name)->with('questions',$question_array);

//        echo $number;
//        print_r($question_array);
//        echo $question_array[$number-1]["answers"][0];
        
    }

    //add course to users_courses table
    public function add($id){
        if(Session::get('Login')!="True")
        {
            return redirect('/UserArea');
        }

        $email = Session::get('Email');

        $user = User::where('email',$email)->first();
        $user->courses()->attach($id);

        return redirect('/Dashboard');
    }

    //save user answer to temp_answers
    public function save($id){

        $email = Session::get('Email');
        $user = User::where('email',$email)->first();

        $answers = tempanswer::where('user_id',$user->id)->where('exercise_id',$id)->get();

            if(count($answers) > 0)
            {
                foreach($answers as $answer) {
                    $count = Input::get('number');
                    for ($i = 0; $i < $count; $i++) {
                        $answerid = Input::get('n' . $i);
                        $temp = tempanswer::where('id', $answerid)->where('user_id', $user->id)->first();

                        if (Input::has('q' . $i)) {
                            $answercheck = Input::get('q' . $i);
                        } else {
                            $answercheck = 0;
                        }

                        $temp->answer = $answercheck;

                        $temp->update();
                    }
                }
            }
            else {

                $count = Input::get('number');
                for ($i = 0; $i < $count; $i++) {
                    $answerid = Input::get('n' . $i);
                    $temp = new tempanswer();
                    $temp->id = $answerid;
                    $temp->user_id = $user->id;

                    $question = Question::where('id', $answerid)->first();

                    foreach($question->exercises as $q){
                        if($q->id == $id){
                            $temp->exercise_id = $q->id;
                        }
                    }

                    if (Input::has('q' . $i)) {
                        $answercheck = Input::get('q' . $i);
                    } else {
                        $answercheck = 0;
                    }
                    $temp->answer = $answercheck;

                    $temp->save();
                }

            }
        $status = 1;
        foreach($user->exercises as $exe){
            if($exe->id == $id){
                $user->exercises()->updateExistingPivot($id,compact('status'));
            }
        }

        return redirect('/Dashboard');
    }

    public function check ($id){

        $count=Input::get('number');
        $correct = 0;
        $status_point =0;
        $total_point = 0;
        $question_array=array();
        for($i=0;$i<$count;$i++){
            $question_array[$i]['id']=Input::get('n'.$i);

            if(Input::has('q'.$i)){
                $answercheck=Input::get('q'.$i);
            }
            else {
                $answercheck=0;
            }
            $question_array[$i]['answerthis']=$answercheck;
            $question_array[$i]['answer']=Input::get('a'.$i);
            $question_array[$i]['content']=Input::get('t'.$i);

            $thisquest = Question::where('id',$question_array[$i]['id'])->get();
            foreach ($thisquest as $quest) {

                $answers=json_decode($quest->options);
                for($j = 0 ;$j < 4;$j++ ){
                     foreach($answers as $answer=>$value) {
                        $question_array[$i]['answers'][$answer]=$value;
                     }
                }

                if($question_array[$i]['answerthis']==0)
                {
                    $question_array[$i]['correct']='N';
                    $question_array[$i]['answerthis']="شما به این سوال پاسخ نداده اید";
                }
                elseif($question_array[$i]['answerthis']==$question_array[$i]['answer']){
                    $question_array[$i]['correct']='C';
                    $question_array[$i]['answerthis']=$question_array[$i]['answers'][$question_array[$i]['answerthis']];
                    $correct ++;
                    switch ($quest->level)
                    {
                        case 0 : $question_array[$i]['level']="ساده";
                            $status_point += 1;
                            break;
                        case 1:  $question_array[$i]['level']="متوسط";
                            $status_point += 2;
                            break;
                        case 2:  $question_array[$i]['level']="سخت";
                            $status_point += 3;
                            break;
                    }
                }
                else {
                    $question_array[$i]['correct']='N';
                    $question_array[$i]['answerthis']=$question_array[$i]['answers'][$question_array[$i]['answerthis']];
                }
                //dd($question_array[$i]['answers'][$question_array[$i]['answer']]);
                $question_array[$i]['answer']=$question_array[$i]['answers'][$question_array[$i]['answer']];
                switch ($quest->level)
                {
                    case 0 : $question_array[$i]['level']="ساده";
                             $total_point += 1;
                        break;
                    case 1:  $question_array[$i]['level']="متوسط";
                             $total_point += 2;
                        break;
                    case 2:  $question_array[$i]['level']="سخت";
                             $total_point += 3;
                        break;
                }
            }
        }

        $email = Session::get('Email');
        $user = User::where('email',$email)->first();
        $score = Score::where('user_id',$user->id)->where('exercise_id',$id)->first();

        if($score){
            $score->c_count=$correct;
            $score->st_point=$status_point;
            $score->percent=($status_point / $total_point) * 100;
        }else {
            $score = new Score();
            $exercise = Exercise::where('id', $id)->first();
            $score->course_id = $exercise->course_id;
            $score->user_id = $user->id;
            $score->exercise_id = $id;
            $score->section_id = $exercise->section_id;
            $score->q_count = $count;
            $score->c_count = $correct;
            $score->st_point = $status_point;
            $score->t_point = $total_point;
            $score->percent = ($status_point / $total_point) * 100;

            try {
                $score->save();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        //use to set status
        $status = 2;
        $user->exercises()->updateExistingPivot($id,compact('status'));

        $temp = tempanswer::where('user_id',$user->id)->where('exercise_id',$id)->get();
        foreach($temp as $t){
            $t->delete();
        }

        return view ('CorrectionAmar10',compact('score'))->with('questions',$question_array);
    }

    public function warning(){
        return view('errors\503');
    }

    public function continuethis(){
        $question_array=array();
        $username=Session::get('UserName');
        $questions=DB::select('select * from tempanswer Where username="'.$username.'"');
        $number=0;
        foreach ($questions as $question) {

            $question_array[$number]['id'] = $question->id;
            $question_array[$number]['checked']=$question->answer;
            $thisquest = DB::select('select * from questions Where id="' . $question_array[$number]['id'] . '"');
            foreach ($thisquest as $quest) {
                $question_array[$number]['content']=$quest->content;
                $question_array[$number]['answer']=$quest->answer;
                $answers=explode(';',$quest->answers);
                //print_r($answers);
                for($i=0;$i<=3;$i++){
                    $question_array[$number]['answers'][$i]=$answers[$i];
                }
                switch ($quest->level)
                {
                    case 0 : $question_array[$number]['level']="ساده";
                        break;
                    case 1:  $question_array[$number]['level']="متوسط";
                        break;
                    case 2:  $question_array[$number]['level']="سخت";
                        break;
                }
            }

            $number++;
        }
        return view('Continue')->with('questions',$question_array);
    }

     public function delete($id){
         $email = Session::get('Email');
         $user = User::where('email',$email)->first();
         $user->courses()->detach($id);

         return redirect('/Dashboard');
     }

    //delete class
    public function deleteclass($id){
        $class = Classes::find($id);

        //delete class's user
        $class->users()->detach();
        //delete class
        $class->delete($id);

        return redirect('/TDashboard');
    }
}
