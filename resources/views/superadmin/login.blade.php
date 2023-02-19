<!DOCTYPE html>
<html lang="en">
<head>
  <title>Saran Clinic :: Super-Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/favicon.png" href="{{url('disc/img/logo1.png')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
    <div class="row mt-5">
      <div class="col-md-3"></div>
            
        <div class="card col-md-6 ">
            @if(Session::has('error'))
                <div class="alert alert-danger mt-2 mb-2 text-center">
                    <span class="">
				        {{Session::get('error')}}
				    </span>
                </div>
			@endif
            <div class="card-header head row">
                <div class="col-12 text-center">
                    <h2 class="">SUPER ADMIN LOGIN</h2>
                </div>
                @if(Session::has('msg'))
              <div class="alert alert-danger" role="alert"><em> {!! session('msg') !!}</em></div>
            @endif
            </div>
            
            <div class="card-body ">
                <div class="text-center">
                    <img src="{{url('disc/img/logo1.png')}}" alt="logo" style="width: 50%; height:auto";>  
                    <hr>
                </div>
                <form method="POST" action="{{url('/superadminlogin')}}">
                    @csrf
                    <div class="form-group">
                        <label><h6>USER ID:</h6></label>
                        <input type="email" class="form-control" id="email" placeholder="--Enter Admin Id--" name="Username" >
                    </div>
						<span class="text-danger">
						@if($errors->has('Username'))
						{{$errors->first('Username')}}
						@endif
						</span>
					
                    <div class="form-group">
                        <label><h6>Password:</h6></label>
                        <input type="password" class="form-control" id="pass" placeholder="--Enter Password--" name="Password" >
                    </div>
					
						<span class="text-danger">
						@if($errors->has('Password'))
						{{$errors->first('Password')}}
						@endif
						</span>
					
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-info btn-lg btn-block">Login</button>
                        
                    </div>
                </form>
            </div>
            <div class="card-footer row" >
                <div class="col-12 text-center">
                
                <!-- Section: Social media -->
                <section class="text-center">
                  <h3> Saran Clinic Lucknow</h3>
                    
                </section>
                <!-- Section: Social media -->
                </div>
            </div>
        </div>
      <div class="col-md-3"></div>
    </div>
    </div>
</body>
</html>