<?php
	require_once "pdo.php";
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}
	if ( isset($_POST['cancel'] ) )
	{
		header("Location: index.php");
		return;
	}



	if ( isset($_POST['log']))
	{

	  if ( isset($_POST['username']) && isset($_POST['password'])  )
	  {
	    $_SESSION["email"]=$_POST["username"];
	    $email = test_input($_SESSION["email"]);

	  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	  {
	        $_SESSION['error'] = "Email must have an at-sign (@)";
	        return;
	  }

	  $sql = "SELECT * FROM users
	    WHERE email = :un";


	  $_SESSION['password']=$_POST['password'];
	  $_SESSION['email']=$_POST['username'];
	  $stmt = $pdo->prepare($sql);
	  $stmt->execute(array(
	      ':un' => $_POST['username']));
	  $row = $stmt->fetch(PDO::FETCH_ASSOC);
	  $algo="md5";
	  $p=$_POST['password'];
	  $po=$row['password'] ?? 0;

	  /*
	  Password checking
	  */
	  $salt = 'XyZzy12*_';
	  $storedHash = hash('md5', $salt.$p);
	  /*
	  Password checking
	  */
	  if ( !($storedHash == $po) )
	  {
	    $_SESSION["error"]="Incorrect password or the email Id is not registered!!!";
	    return;

	  }
	  else
	  {
	    $_SESSION['user_Id'] = $row['userId'];
	      $_SESSION['firstName'] = $row['firstName'];
	      $_SESSION['lastName'] = $row['lastName'];
	      $_SESSION['phone'] = $row['mobileNumber'];
	      $_SESSION['userRole'] = $row['status'];
	      $_SESSION['flash'] = "Login Success";

	        header("Location: viewByAdmin.php");


	  }

	}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Login</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/nunito-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/style.css"/>
      <script type="text/javascript" href="js/main.js"/></script>
      <style>
a:link {
  color: white;
  background-color: transparent;
  text-decoration: none;
}

a:visited {
  color: white;
  background-color: transparent;
  text-decoration: none;
}

a:hover {
  color: white;
  background-color: transparent;
  text-decoration: underline;
}

a:active {
  color: white;
  background-color: transparent;
  text-decoration: underline;
}
* {
  box-sizing: border-box;
}

.button {
  position: relative;
  display: block;
  width: 200px;
  height: 36px;
  border-radius: 18px;
  background-color: #1c89ff;
  border: solid 1px transparent;
  color: #fff;
  font-size: 18px;
  font-weight: 300;
  cursor: pointer;
  transition: all .1s ease-in-out;
  &:hover {
    background-color: transparent;
    border-color: #fff;
    transition: all .1s ease-in-out;
  }

}


.loader {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50px;
  height: 50px;
  background: transparent;
  margin: 30px auto 0 auto;
  border: solid 2px #424242;
  border-top: solid 2px #1c89ff;
  border-radius: 50%;
  opacity: 0;
}

.check {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  transform: translate3d(-4px,50px,0);
  opacity: 0;
  span:nth-child(1) {
    display: block;
    width: 10px;
    height: 2px;
    background-color: #fff;
    transform: rotate(45deg);
  }
  span:nth-child(2) {
    display: block;
    width: 20px;
    height: 2px;
    background-color: #fff;
    transform: rotate(-45deg) translate3d(14px, -4px, 0);
    transform-origin: 100%;
  }
}

.loader.active {
  animation: loading 2s ease-in-out;
  animation-fill-mode: forwards;
}

.check.active {
  opacity: 1;
  transform: translate3d(-4px,4px,0);
  transition: all .5s cubic-bezier(.49, 1.74, .38, 1.74);
  transition-delay: .2s;
}

@keyframes loading {
  30% {
    opacity:1;
  }

  85% {
    opacity:1;
    transform: rotate(1080deg);
    border-color: #262626;
  }
  100% {
    opacity:1;
    transform: rotate(1080deg);
     border-color: #1c89ff;
  }
}
a[href='#finish']{ display: none }
.actions{
	display:none;
}
</style>
</head>
<body>
	<div class="page-content">
		<div class="wizard-v5-content">
			<div class="wizard-form">
		        <form class="form-register" action="" method="POST">
		        	<div id="form-total">
                <div style="text-align:center;">
                <h3 style="padding-left:60%;color:white;"><a href="index.php">Make Payment</a></h3>
                <h3 style="padding-left:60%;"><a href="checkStatus.php">Check Status of payment</a></h3>
              </div>

		        		<!-- SECTION 1 -->
			            <h2>
			            
			            	<span class="step-text">Admin Login</span>
			            </h2>
			            <section>
			                <div class="inner">
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="email">Email Address:</label>
										<input type="email" name="username" class="email input-step-2-1" id="email" placeholder="ex: example@email.com" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" required>
									</div>
								</div>
								<div class="form-row">

									<div class="form-holder">
										<label for="code">Password:</label>
										<input type="password" class="form-control" id="phone" name="password" required>
									</div>
								</div>

								<div class="form-row">
									<div class="main">
									  <input type="submit" name="log"  class="button" value="Login"></input>
									</div>
							</div>

							</div>
			            </section>
						<!-- SECTION 2 -->

			            <!-- SECTION 3 -->

		        	</div>
		        </form>
			</div>
		</div>
	</div>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery.steps.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
