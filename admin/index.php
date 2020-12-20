<?php  
 session_start();  
 if(isset($_SESSION["user"]))  
 {  
      header("location:home.php");  
 }  
 
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            color: #4e4e4e;
            background: #e2e2e2;
            font-family: 'Roboto', sans-serif;
        }

        .form-control {
            font-size: 16px;
            background: #f2f2f2;
            box-shadow: none !important;
            border-color: transparent;
        }

        .form-control:focus {
            border-color: #d3d3d3;
        }

        .form-control,
        .btn {
            border-radius: 2px;
        }

        .login-form {
            width: 380px;
            margin: 120px auto;
        }

        .login-form h2 {
            margin: 0;
            padding: 30px 0;
            font-size: 34px;
        }

        .login-form .avatar {
            margin: 0 auto 30px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            z-index: 9;
            background: #428bca;
            padding: 15px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .login-form .avatar img {
            width: 100%;
        }

        .login-form form {
            color: #7a7a7a;
            border-radius: 4px;
            margin-bottom: 15px;
            background: #fff;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form .btn {
            font-weight: bold;
            background: #428bca;
            border: none;
            margin-bottom: 20px;
        }

        .login-form .btn:hover,
        .login-form .btn:focus {
            background: #428bca;
            outline: none !important;
        }

        .login-form a {
            color: #428bca;
        }

        .login-form form a {
            color: #428bca;
        }

        .login-form a:hover,
        .login-form form a:hover {
            text-decoration: underline;
        }

        .hint-text {
            color: #999;
            text-align: center;
        }

        .form-footer {
            padding-bottom: 15px;
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="login-form">
        <h2 class="text-center">Member Login</h2>
        <form method="post">
            <div class="avatar">
                <img src="https://img.icons8.com/ios-filled/50/000000/user-male-circle.png"/>
            </div>
            <div class="form-group">
                <input type="text" class="form-control input-lg" name="user" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control input-lg" name="pass" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Sign in</button>
            </div>
            <p class="hint-text">Don't have an account? <a href="#">Sign up here</a></p>
        </form>
        <div class="form-footer"><a href="#">Forgot Your Password?</a></div>
    </div>
</body>

</html>

<?php
   include('db.php');
  
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($con,$_POST['user']);
      $mypassword = mysqli_real_escape_string($con,$_POST['pass']); 
      
      $sql = "SELECT id FROM login WHERE usname = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         $_SESSION['user'] = $myusername;
         
         header("location: home.php");
      }else {
         echo '<script>alert("Your Login Name or Password is invalid") </script>' ;
      }
   }
?>
