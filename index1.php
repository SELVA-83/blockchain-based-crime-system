<?php require_once('includes/db.php');

if(isset($mysqli,$_POST['submit'])){
    $username = mysqli_real_escape_string($mysqli,$_POST['username']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);
    $password=($password);
    $query1=mysqli_query($mysqli,"SELECT username,password,type,permission,name,surname FROM users");
	while($row=mysqli_fetch_array($query1))
	{
        $db_name=$row["name"];
		$db_surname=$row["surname"];
		$db_username=$row["username"];
		$db_password=$row["password"];
		$db_type=$row["type"];
        $db_per=$row["permission"];
		
		if($username==$db_username && $password==$db_password){
			session_start();
			$_SESSION["username"]=$db_username;
			$_SESSION["type"]=$db_type;
            $_SESSION["permission"]=$db_per;
            $_SESSION["name"]=$db_name;
            $_SESSION["surname"]=$db_surname;
			
			if($_SESSION["type"]=='user'){
               
				header("Location:admin/dashboard.php");
			}
		}
		
	
    }
}

?>
<?php 
session_start();
include("includes/dbconnect.php");
extract($_POST);
$msg="";
if(isset($submit))
{
 if(trim($username=="")) { $msg = "Enter the Username"; }
 else if(trim($password=="")) { $msg = "Enter the Password"; }
	 else
	 {
	 	
		$qry = "select * from users where username='$username' && password='$password'";
			$exe=mysql_query($qry);
			$num=mysql_num_rows($exe);
				if($num==1)
				{
					$_SESSION['username']=$username;
					header("location:admin/dashboard.php");
				}
				else
				{
				$msg="Login Incorrect!";
				}
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Crime Reporting | LOGIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #0BE0FD">
	
	
	<div class="container-login100">
	<a class="login100-form-btn" href="index.php">ADMIN LOGIN</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="login100-form-btn" href="login.php">USER LOGIN</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="login100-form-btn" href="register.php">USER REGISTER</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href=""><img src="images/2.jpg" width="1260" height="250"></a>
		<div>
			<form class="login100-form validate-form" method="post" action="index.php">
				<span class="login100-form-title p-b-37">
					CYBER CRIME ADMIN LOGIN
				</span>
				
					<div style="color:#990000"><?php echo $msg; ?></div>
				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username ">
					<input class="input100" type="text" name="username" placeholder="username ">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="password" placeholder="password">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" type="submit" name="submit">
						Sign In
					</button>
				</div>
			</form>

		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>