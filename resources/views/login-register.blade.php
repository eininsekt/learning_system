
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login/register</title>
	<link rel="favicon" href="{{URL::asset('images/favicon.png')}}">
	<!-- custome js just for login page -->
	<link rel="stylesheet" href="{{URL::asset('css/login/css/reset.css')}}">
	<link rel="stylesheet" href="{{URL::asset('css/login/css/style.css')}}">
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
<div class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<!-- Button for smallest screens -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
			<a class="navbar-brand" href="/">
				<img src="{{URL::asset('images/logo.png')}}" alt="Techro HTML5 template"></a>
		</div>
		<div class="navbar-collapse collapse" >
			<ul class="nav navbar-nav pull-right mainNav" >
				<li><a href="/">صفحه ی اصلی</a></li>
				<li><a href="/#AboutUs">درباره ی ما</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">تمرین
						&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu dropdown-menu-right multi-column columns-3" >
						<div class="row">
							<div class="col-sm-4">
								<ul class="multi-column-dropdown">
									<li class="dropdown-header">دوره ی دهم</li>
									<li><a href="/Courses/amar10">آمار</a></li>
									<li class="disabled"><a href="#">ریاضی</a></li>
								</ul>
							</div>
							<div class="col-sm-4">
								<ul class="multi-column-dropdown">
									<li class="dropdown-header">دوره ی یازدهم</li>
									<li><a href="#">آمار</a></li>
									<li class="disabled"><a href="#">احتمال</a></li>
									<li class="disabled"><a href="#">ریاضی</a></li>
								</ul>
							</div>
							<div class="col-sm-4">
								<ul class="multi-column-dropdown">
									<li class="dropdown-header">دوره ی دوازدهم</li>
									<li><a href="#">آمار</a></li>
								</ul>
							</div>
						</div>
					</ul>
				</li>
				<li><a href="#">آموزش</a></li>
				<li><a href="/Contact">ارتباط با ما</a></li>
				<?php
				if(Session::get('Login')=="True")
				{
				?>
				<li><a href="/Dashboard">داشبورد</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Session::get('Name')}}
						&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="/Profile">پروفایل</a></li>
						<li><a href="/Logout">خروج</a></li>
					</ul>
				</li>
				<?php
				}
				else {
				?>
				<li class="active"><a href="#">ورود | ثبت نام</a></li>
				<?php
				}
				?>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>
<!-- /.navbar -->

		<header id="head" class="secondary">
            <div class="container">
                    <h1>ورود | ثبت نام</h1>
                    <p></p>
                </div>
    </header>


	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-3">
					</div>
					<div class="col-md-6">
						<!-- Form Module-->
						<div class="module form-module">
							<div class="toggle " >
								<i class="fa fa-times fa-pencil"></i>
								<div class="tooltips">ثبت نام</div>
							</div>
							<div class="form">
								<h2>وارد حساب کاربریت شو :-)</h2>
								<form action="/Login" method="post">
									@if( ! empty($valid))
										<p style="color:red;">رمز و نام کاربری شما مطابقت ندارد</p>
									@endif
									<input type="checkbox"><label>معلم هستید؟</label>
									<input type="text" name="username" placeholder="نام کاربری"/>
									<input type="password" name="password" placeholder="گذر واژه"/>
									<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
									<input type="submit" value="ورود">
								</form>
							</div>
							<div class="form">
								<h2>حساب کاربری جدید بساز :-)</h2>
								<form action="/SignUp" method="post" onsubmit="return checklogin()">
									<input type="checkbox"><label>معلم هستید؟</label>
									<input type="text" name="name" placeholder="نام و نام خانوادگی"/>
									<input type="text" name="username" placeholder="نام کاربری"/>
									<input type="password" id="pass" name="password" placeholder="گذر واژه"/>
									<input type="password" id="repass" name="repassword" placeholder="تکرار گزر واژه"/>
									<input type="email" name="email" placeholder="ایمیل"/>
									<input type="tel" name="phone" placeholder="تلفن"/>
									<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
									<select style="display:none" name="school">
										<option value="0" selected>مدرسه من در این مدارس نیست</option>
										<option value="1">فرزانگان ۱</option>
										<option value="2">علامه حلی</option>
									</select>
									<input type="submit" value="ثبت نام">
								</form>
							</div>
							<div class="cta"><a href="http://andytran.me">رمزم را فراموش کردم. :-(</a></div>
						</div>
					</div>
					<div class="col-md-3">
					</div>
				</div>
			</div>
	<!-- /container -->

	<footer id="footer">

	<div class="container">
		<div class="row">
			<div class="footerbottom">
				<div class="col-md-3 col-sm-6 footer-col">
					<div class="footerwidget">
						<h4><a href="#" data-toggle="modal" data-target="#teacher-modal">
							اساتید عضو
						</a></h4>
						<div class="menu-course">
							<ul class="menu">
								<li><a href="#">
									مریم رهبر زارع
								</a>
								</li>
								<li><a href="#">
									احمد بیات
								</a>
								</li>
								<li><a href="#">
									سهیلا مورچگانی
								</a>
								</li>
								<li><a href="#">
									میرهادی سرکارفرشی
								</a>
								</li>
								<li><a href="#">
									سپیده صاحب فصولی
								</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 footer-col">
					<div class="footerwidget">
						<h4><a href="#" data-toggle="modal" data-target="#school-modal">
							مدارس عضو
						</a></h4>
						<div class="menu-course">
							<ul class="menu">
								<li> <a href="#">
									فرزانگان 3 کرج
								</a>
								</li>
								<li><a href="#">
									علامه حلی 4 تهران
								</a>
								</li>
								<li><a href="#">
									شهدای کارگر
								</a>
								</li>
								<li><a href="#">
									ابوریحان
								</a>
								</li>
								<li><a href="#">
									سلام صادقیه
								</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 footer-col">
					<div class="footerwidget">
						<h4><a href="#" data-toggle="modal" data-target="#course-modal">
							دروس ارائه شده
						</a></h4>
						<div class="menu-course">
							<ul class="menu">
								<li><a href="#">
									آمار
								</a>
								</li>
								<li> <a href="#">
									ریاضی 2
								</a>
								</li>
								<li><a href="#">
									ریاضی 1
								</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 footer-col">
					<div class="footerwidget">
						<h4><a href="/Contact">ارتباط با ما</a></h4>
						<p>ارتباط مستقیم</p>
						<div class="contact-info">
							<i class="fa fa-map-marker"></i>&nbsp; تهران، چهارراه ولیعصر، دانشگاه صنعتی امیرکبیر<br>
							<i class="fa fa-phone"></i>&nbsp; 021-22224444<br>
							<i class="fa fa-envelope-o"></i>&nbsp; youremail@email.com
						</div>
					</div><!-- end widget -->
				</div>
			</div>
		</div>
		<div class="supporter text-center">
			<h4>حامیان: &nbsp;</h4>
			<a  href="http://www.aut.ac.ir"><img  src="images/AKUT.svg.png" title="دانشگاه صنعتی امیرکبیر"></a>
			<a href="#"></a>
		</div>
		<div class="social text-center">
			<a href="#"><i class="fa fa-twitter" title="twitter"></i></a>
			<a href="#"><i class="fa fa-facebook" title="facebook"></i></a>
			<a href="#"><i class="fa fa-instagram" title="instagram"></i></a>
			<a href="#"><i class="fa fa-location-arrow" title="telegram"></i></a>
		</div>

		<!-- Modal -->
		<!--Teacher Modal-->
		<div id="teacher-modal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<br/>
						<h4 class="modal-title">اساتید عضو در سایت :</h4>
					</div>
					<div class="modal-body">
						<p>جستجو در نام اساتید:</p>
						<form>
							<input class="search-modal" type="text" name="search" placeholder="جستجو ...">
						</form>
						<hr>
						<div class="result-search">
							<div class="teacher-block">
								<img src="images/profile1.png">
								<p>مریم رهبر زارع</p>
							</div>
							<div class="teacher-block">
								<img src="images/profile2.png">
								<p>مریم رهبر زارع</p>
							</div>
							<div class="teacher-block">
								<img src="images/profile1.png">
								<p>مریم رهبر زارع</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">ببندش!</button>
					</div>
				</div>

			</div>
		</div>
		<!-- /Teacher Modal-->
		<!--school Modal-->
		<div id="school-modal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<br/>
						<h4 class="modal-title">مدارس ثبت شده در سایت: </h4>
					</div>
					<div class="modal-body">
						<p>جستجو در نام مدارس:</p>
						<form>
							<input class="search-modal" type="text" name="search" placeholder="جستجو ...">
						</form>
						<hr>
						<div class="result-search">
							<div class="school-block">
								<p>فرزانگان 3</p>
								<p>کرج - بلوار امام رضا - اردلان 3</p>
							</div>
							<div class="school-block">
								<p>فرزانگان 3</p>
								<p>کرج - بلوار امام رضا - اردلان 3</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">ببندش!</button>
					</div>
				</div>

			</div>
		</div>
		<!-- /school Modal-->
		<!--school Modal-->
		<div id="course-modal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<br/>
						<h4 class="modal-title">دروس  موجود در سایت: </h4>
					</div>
					<div class="modal-body">
						<p>جستجو در نام دروس:</p>
						<form>
							<input class="search-modal" type="text" name="search" placeholder="جستجو ...">
						</form>
						<hr>
						<div class="result-search">
							<div class="course-block">
								<p>آمار</p>
								<p>مقطع: &nbsp;<span>دهم</span></p>
							</div>
							<div class="course-block">
								<p>ریاضی</p>
								<p>مقطع: &nbsp;<span>دهم</span></p>
							</div>
							<div class="course-block">
								<p>آمار</p>
								<p>مقطع: &nbsp;<span>دهم</span></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">ببندش!</button>
					</div>
				</div>

			</div>
		</div>
		<!-- /school Modal-->
		<!-- /Modal -->

		<div class="clear"></div>
		<!--CLEAR FLOATS-->
	</div>
	<div class="footer2">
		<div class="container">
			<div class="row">
				<div class="col-md-4 panel footer-col">
					<div class="panel-body">
						<p class="simplenav">
							<a href="/">صفحه اصلی</a> |
							<a href="/#AboutUs">درباره ی ما</a> |
							<a href="#">آموزش</a> |
							<a href="/Contact">ارتباط با ما</a> |
							<a href="/Dashboard">داشبورد</a>
						</p>
					</div>
				</div>
				<div class="col-md-5 panel footer-col">
				</div>
				<div class="col-md-3 panel footer-col">
					<p class="text-right">
						Copyright &copy; 2016 example.com
					</p>
				</div>
			</div>
			<!-- /row of panels -->
		</div>
	</div>
</footer>


	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<!-- custome js just for login page -->
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<!-- custome js just for login page -->
<script src="{{URL::asset('js/login/index.js')}}"></script>
<script src="{{URL::asset('js/custom.js')}}"></script>

<!-- Google Maps -->
<script src="{{URL::asset('js/Gmap.JS')}}"></script>
<script src="{{URL::asset('js/google-map.js')}}"></script>


</body>
</html>
