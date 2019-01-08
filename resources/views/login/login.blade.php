<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="img/favicon.ico">


  <!-- Bootstrap core CSS-->
  <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/css/line-awesome.css">
  <link rel="stylesheet" type="text/css" href="vendor/css/line-awesome-font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/css/font-awesome.min.css">

  <!-- Custom fonts for this template-->
  <link href="vendor/css/login-style.css" rel="stylesheet" type="text/css">
  <title>Login</title>
</head>
<body>
  <div class="login-page">
  <div class="container ">
     <a class="btn btn-primary" style="margin:auto 0;text-align: center;height: 50px;width: 300px;" href="http://localhost/new/go.php" role="button">MAP</a>
    <div class="row">

      
      <div class="col-md-6 logo-border"> 
        <div class="img-container">
         <img src="logo.png" id="login-img" class="align-items-center img-responsive center-block mx-auto align-middle"><br>
        </div>
      </div>
        <div class="col-md-6"> 
          <div class="card card-login mx-auto mt-5">
            <div class="card-header" style="font-weight: 700;">Login</div>
              <div class="card-body">

                  <form method="post" >
                    {{@csrf_field()}}
                    <div class="form-group">
                        <div class="form-label-group">
                          <input type="name" name="userid" id="inputEmail" class="form-control" placeholder="User Name" autofocus="autofocus" value="{{old('userid')}}">
                          <label for="inputEmail">User Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                          <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                          <label for="inputPassword">Password</label>
                        </div>
                    </div>
                    <div>
                      <p style="color: red;">{{session('errormessage')}}</p>
                      @if($errors->any())
                          @foreach($errors->all() as $error)
                            <p style="color: red;">{{$error}}</p>
                          @endforeach
                      @endif
                    </div>
                    <input class="btn btn-primary  btn-block " type="submit" value ="CONNECT" />
                  </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>