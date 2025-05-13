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
        <meta charset="utf-8">
        <title>Crime Complaint</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Law Firm Website Template" name="keywords">
        <meta content="Law Firm Website Template" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@1,600;1,700;1,800&family=Roboto:wght@400;500&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
            <!-- Top Bar Start -->
            <div class="top-bar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="logo">
                                <a href="index.html">
                                    <h1>Crime Complaint</h1>
                                    <!-- <img src="img/logo.jpg" alt="Logo"> -->
                                </a>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->

            <!-- Nav Bar Start -->
            <div class="nav-bar">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                        <a href="#" class="navbar-brand">MENU</a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto">
                           <a href="index.html" class="nav-item nav-link active">Home</a>
                                <a href="admin.php" class="nav-item nav-link">Admin</a>
                                <a href="login.php" class="nav-item nav-link">User</a>
                                <a href="register.php" class="nav-item nav-link">Register</a>
                             
                        
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Nav Bar End -->
            
            
            <!-- Page Header Start -->
            <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Admin Login</h2>
                        </div>
                        <div class="col-12">
                            <a href="">Home</a>
                            <a href="">Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->


            <!-- Contact Start -->
            <div class="contact">
                <div class="container">
                    <div class="section-header">
                        <h2>Admin Login</h2>
                    </div>
                    <div class="row">
                      
                        <div class="col-md-8">
                            <div class="contact-form">
		
  
			<form class="login100-form validate-form" method="post" action="admin.php">
				
				<div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="Your Username" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Your Password" required="required" />
                                    </div>
									
			 <div>
									<input type="submit" class="btn" name="submit"  value="Submit" ">
                                      
                                    </div>
				
						

		</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact End -->


           
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
