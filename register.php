<?php
session_start();
include("includes/dbconnect.php");
extract($_POST);


function crimechain($uid,$uname,$bcdata,$utype)
{
    ############
	$mon=date("m");
    $rdate=date("d-m-Y");
   $ch1=mktime(date('h')+5,date('i')+30,date('s'));
$rtime=date('h:i:s A',$ch1);
    
    $ff=fopen("key.txt","r");
    $k=fread($ff,filesize("key.txt"));
    fclose($ff);
    
    #bcdata="CID:"+uname+",Time:"+val1+",Unit:"+val2
    $dtime=$rdate.",".$rtime;

    $ff1=fopen("js/d1.txt","r");
    $bc1=fread($ff1,filesize("js/d1.txt"));
    fclose($ff1);
    
    $px="";
    if($k=="1")
	{
        $px="";
		$rn=rand(100,999);
        $result = md5($bcdata);
        $key=substr($result,0,32);
        
        $v=$k."##".$key."##".$bcdata."##".$dtime;

		$ff1=fopen("js/d1.txt","w");
    	fwrite($ff1,$v);
   		fclose($ff1);
       
        
        $dictionary = array(
            "ID"=> "1",
            "Pre-hash"=> "00000000000000000000000000000000",
            "Hash"=> $key,
            "utype"=> $utype,
            "Date/Time"=> $dtime
        );

        $k1=$k;
        $k2=$k1+1;
        $k3=$k2;
        $ff1=fopen("key.txt","w");
        fwrite($ff1,$k3);
        fclose($ff1);
		
		$ff1=fopen("prehash.txt","w");
        fwrite($ff1,$key);
        fclose($ff1);

   	  
    }    
    else
	{
        $px=",";
        $pre_k="";
        $k1=$k;
        $k2=$k1-1;
        $k4=$k2;

		$ff1=fopen("prehash.txt","r");
        $pre_hash=fread($ff1,filesize("prehash.txt"));
        fclose($ff1);
		
        
        $g1=explode("#|",$bc1);
        foreach($g1 as $g2)
		{
            $g3=explode("##",$g2);
            if($k4==$g3[0])
			{
                $pre_k=$g3[1];
                break;
			}
		}
        
        $result = md5($bcdata);
        $key=$result;
        

        $v="#|".$k."##".$key."##".$bcdata."##".$dtime;

        $k3=$k2;
		
		$ff1=fopen("key.txt","w");
        fwrite($ff1,$k3);
        fclose($ff1);
        
		$ff1=fopen("js/d1.txt","a");
        fwrite($ff1,$v);
        fclose($ff1);

        
        $dictionary = array(
            "ID"=> $k,
            "Pre-hash"=> $pre_hash,
            "Hash"=> $key,
            "utype"=> $utype,
            "Date/Time"=> $dtime
        );
        
        $k21=$k+1;
        $k3=$k21;
		
		$ff1=fopen("key.txt","w");
        fwrite($ff1,$k3);
        fclose($ff1);
		
    	$ff1=fopen("prehash.txt","w");
        fwrite($ff1,$key);
        fclose($ff1);

      
	
 	}
    # Serializing json
	
	$m="";
    if(k=="1")
	{
        $m="w";
	}
    else
	{
       $m="a";
	 }
	//$json_data = json_encode($dictionary, JSON_PRETTY_PRINT);
	$json_data = json_encode($dictionary);

// Write JSON to file
//file_put_contents("crimechain.json", $json_data);
$ff1=fopen("crimechain.json",$m);
        fwrite($ff1,$json_data);
        fclose($ff1);
}

if(isset($btn))
{
	$max_qry = mysql_query("select max(id) maxid from register");
	$max_row = mysql_fetch_array($max_qry);
	$id=$max_row['maxid']+1;
	$rdate=date("d-m-Y");
	
		 $a=("insert into register(id,name,mobile,address,email,uname,pass,rdate) values('$id','$name','$mobile','$address','$email','$uname','$pass','$rdate')");
	$res=mysql_query($a);
	
	if($res)
		{
		
		$bcdata="ID:".$id.", Name: ".$name.", Username:".$uname.", New User Registered";
        crimechain($id,$uname,$bcdata,'user');
							
		?>
		<script language="javascript">
		alert("Registered Successfully");
		window.location.href="index.php";
		</script>
		<?php
		}
		else
		{
		$msg="Could not be stored!";
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
                            <h2>Register</h2>
                        </div>
                        <div class="col-12">
                            <a href="">Home</a>
                            <a href="">Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->


            <!-- Contact Start -->
            <div class="contact">
                <div class="container">
                    <div class="section-header">
                        <h2>Register</h2>
                    </div>
                    <div class="row">
                      
                        <div class="col-md-8">
                            <div class="contact-form">
		<form id="form1" name="form1" method="post" action="">
  

									<div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Your Name" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mobile" class="form-control" placeholder="Your Mobile Number" required="required" />
                                    </div>
									<div class="form-group">
                                        <textarea name="address" class="form-control" placeholder="Your Address" required="required" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Your Email" required="required" />
                                    </div>
									<div class="form-group">
                                        <input type="text" name="uname" class="form-control" placeholder="Your Username" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="pass" class="form-control" placeholder="Your Password" required="required" />
                                    </div>
                                    <div class="form-group">
                                      <input type="password" name="cpass" class="form-control" placeholder="Your Confirm Password" required="required" />
                                    </div>
                                    <div>
									<input type="submit" class="btn" name="btn" value="Submit" onClick="return validate()">
                                      
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
