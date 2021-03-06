
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل کاربری</title>
    <link rel="favicon" href="{{URL::asset('images/favicon.png')}}">
    <!-- custome js just for login page -->

    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/fontiran.css')}}">
    <!-- Custom styles for our template -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap-theme.css')}}" media="screen">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">

    <link rel="stylesheet" href="{{URL::asset('css/general.css')}}">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{URL::asset('js/html5shiv.js')}}"></script>
    <script src="{{URL::asset('js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body>
<!-- Fixed navbar -->
@include('navbar',array('active'=>'profile'))
<!-- /.navbar -->

<header id="head" class="secondary">
    <div class="container">
        <h1>اطلاعات شخصی</h1>
        <p></p>
    </div>
</header>

<!-- container -->
<div class="container">
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <h3 class="section-title">اطلاعات شخصی</h3>
            @if($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form id="changeProfile" class="form-light mt-20" role="form" action="/Profile" method="post">

            <div class="form-group">
                <label>نام و نام خانوادگی</label>
                <input id="whole-name" type="text" name="name" class="form-control" value="{{$info['name']}}">
            </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ایمیل</label>
                        <input type="email" name="email" class="form-control" value="{{$info['email']}}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>تلفن</label>
                        <input id="phone" type="text" name="phone" class="form-control" value="{{$info['phone']}}">
                    </div>
                </div>
                @if($info['type'] == 'teacher')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>مدرسه</label>
                            <select class="form-control" name="school">
                                @foreach($schools as $school)
                                    @if($user->school_id == $school->id)
                                        <option value="{{$school->id}}" selected>{{$school->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                <button id="sub_button" form="changeProfile" type="submit" class="btn btn-two" disabled>ثبت تغییر</button><p><br/></p>
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            </form>
            <hr/>
                <form class="form-light mt-20" role="form" action="/ChangePass" method="post" onsubmit="return checkold()">
                    <div class="form-group">
                        <h4>تغییر رمز</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>رمز قبلی</label>
                                     <input type="password"  name="oldpass" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رمز جدید</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <button type="submit" class="btn btn-two">تغییر رمز</button><p><br/></p>
        </form>
    </div>
    </div>
</div>
<!-- /container -->

@include('footer')

<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<!-- custome js just for login page -->
<script src="{{URL::asset('js/custom.js')}}"></script>
<script src="{{URL::asset('js/profilecheck.js')}}"></script>

<!-- Google Maps -->
<script src="{{URL::asset('js/Gmap.JS')}}"></script>
<script src="{{URL::asset('js/google-map.js')}}"></script>

<script>
    $('#phone').on('change', function(){
        $('#sub_button').removeAttr('disabled');
    });
    $('#whole-name').on('change', function(){
        $('#sub_button').removeAttr('disabled');
    });
</script>

</body>
</html>
