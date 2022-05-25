<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>NubiaVilla</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />	
	<!-- Style-CSS -->	
	<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}" >
    <link rel="stylesheet" href="{{ asset('assets/users/assets/modules/fontawesome-free/css/all.min.css') }}">
</head>

<body class="app header-fixed sidebar-fixed sidebar-lg-show">    
    <div class="container" id="app">
	    <div class="row align-items-center justify-content-center auth">
	        <div class="col-md-6 col-lg-5">
				<div class="card">
					<div class="card-block">						
						<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}" novalidate>		
							@csrf					
							<div class="auth-header">
								<h1 class="auth-title">Register</h1>
								<p class="auth-subtitle">Sign Up to your account</p>								
							</div>
							<div class="auth-body">
                                <div class="form-group">
                                    <label for="name">{{ __('Full Name') }}</label>
                                    <div class="input-group input-group--custom">
                                        <div class="input-group-addon"><i class="input-icon fa fa-user"></i></div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your fullname"  value="{{ old('name') }}" required autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                        
                                <div class="form-group">
									<label for="email">Your e-mail</label>
									<div class="input-group input-group--custom">
										<div class="input-group-addon"><i class="input-icon input-icon--mail"></i></div>
										<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Your e-mail"  value="{{ old('email') }}" required autofocus>
										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>									
								</div>                                            
								
								<div class="form-group">
									<label for="password">Password</label>
									<div class="input-group input-group--custom">
										<div class="input-group-addon"><i class="input-icon input-icon--lock"></i></div>
										<input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password"  required>										  
										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>									
								</div>

                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                    <div class="input-group input-group--custom">
										<div class="input-group-addon"><i class="input-icon input-icon--lock"></i></div>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                    </div>
                                </div>

								<div class="form-group">									
									<button type="submit" class="btn btn-block btn-spinner" style="background-color:#563d7c"><i class="fa"></i> Register</button>
								</div>								
								<div class="float-right auth-subtitle">Already have an account ? <a href="{{route('login')}}"> Login here</a></div>
							</div>
							<div class="clear-both"></div>
						</form>							
					</div>
				</div>
	        </div>
	    </div>
	</div>   
    
</body>
<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
<script src="{{ asset ('asset/js/admin.js') }}"></script>    
<script type="text/javascript">  
    document.getElementById('password').dispatchEvent(new Event('input'));
</script>
</html>
