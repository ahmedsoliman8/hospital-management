@extends('Dashboard.layouts.master2')
@section('css')
	<style>
		.panel {display: none;}
	</style>
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('Dashboard/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">

												<h2>{{trans('Dashboard/login_trans.welcome_back')}}</h2>
												@if ($errors->any())
													<div class="alert alert-danger">
														<ul>
															@foreach ($errors->all() as $error)
																<li>{{ $error }}</li>
															@endforeach
														</ul>
													</div>
												@endif
												<div class="form-group">
													<label for="exampleFormControlSelect1">حدد طريقة الدخول</label>
													<select class="form-control"  id="sectionChooser">
														<option value="" selected disabled>اختار من القائمة</option>
														<option value="user">الدخول كمريض</option>
														<option value="admin">الدخول ك ادمن</option>
													</select>
												</div>
												{{--form user--}}
												<div class="panel" id="user">
												<h5 class="font-weight-semibold mb-4">الدخول مريض</h5>
												<form method="POST" action="{{ route('login.user') }}">
													@csrf
													<div class="form-group">
														<label>Email</label> <input class="form-control" placeholder="Enter your email" type="text" name="email" :value="old('email')" required autofocus>
													</div>
													<div class="form-group">
														<label>Password</label> <input class="form-control" placeholder="Enter your password" type="password"    type="password"
																					   name="password"
																					   required autocomplete="current-password" >
														<!-- Remember Me -->
														<div class="form-group">
															<label for="remember_me" class="inline-flex items-center">
																<input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
																<span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
															</label>
														</div>
													</div><button type="submit" class="btn btn-main-primary btn-block">   {{ __('Log in') }}</button>
													<div class="row row-xs">
														<div class="col-sm-6">
															<button class="btn btn-block"><i class="fab fa-facebook-f"></i> Signup with Facebook</button>
														</div>
														<div class="col-sm-6 mg-t-10 mg-sm-t-0">
															<button class="btn btn-info btn-block"><i class="fab fa-twitter"></i> Signup with Twitter</button>
														</div>
													</div>
												</form>
												<div class="main-signin-footer mt-5">
													<p>
														@if (Route::has('password.request'))
															<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
																{{ __('Forgot your password?') }}
															</a>
														@endif
													</p>
													<p>Don't have an account? <a href="{{ url('/register') }}">Create an Account</a></p>
												</div>
												</div>

												{{--form admin--}}
												<div class="panel" id="admin">
													<h5 class="font-weight-semibold mb-4">الدخول أدمن</h5>
													<form method="POST" action="{{ route('login.admin') }}">
														@csrf
														<div class="form-group">
															<label>Email</label> <input class="form-control" placeholder="Enter your email" type="text" name="email" :value="old('email')" required autofocus>
														</div>
														<div class="form-group">
															<label>Password</label> <input class="form-control" placeholder="Enter your password" type="password"    type="password"
																						   name="password"
																						   required autocomplete="current-password" >
															<!-- Remember Me -->
															<div class="form-group">
																<label for="remember_me" class="inline-flex items-center">
																	<input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
																	<span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
																</label>
															</div>
														</div><button type="submit" class="btn btn-main-primary btn-block">   {{ __('Log in') }}</button>
														<div class="row row-xs">
															<div class="col-sm-6">
																<button class="btn btn-block"><i class="fab fa-facebook-f"></i> Signup with Facebook</button>
															</div>
															<div class="col-sm-6 mg-t-10 mg-sm-t-0">
																<button class="btn btn-info btn-block"><i class="fab fa-twitter"></i> Signup with Twitter</button>
															</div>
														</div>
													</form>
													<div class="main-signin-footer mt-5">
														<p>
															@if (Route::has('password.request'))
																<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
																	{{ __('Forgot your password?') }}
																</a>
															@endif
														</p>
														<p>Don't have an account? <a href="{{ url('/register') }}">Create an Account</a></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
	<script>
        $('#sectionChooser').change(function(){
            var myID = $(this).val();
            $('.panel').each(function(){
                myID === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
	</script>
@endsection