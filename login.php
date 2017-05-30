<?php
	require("common.php");
	if(!empty($_SESSION['user'])){
		header("Location: admin.php");
		die("Redirecting to admin.php");
	}

	function login(){
		if (isset($_GET['login'])){
			require("common.php");

			$submitted_email = '';
			$correction = 'none';

			if(!empty($_POST))
			{
				$query = "
					SELECT *
					FROM users
					WHERE
						email = :email";

				$query_params = array(
					':email' => $_POST['email']
				);

				try
				{
					$stmt = $db->prepare($query);
					$result = $stmt->execute($query_params);
				}
				catch(PDOException $ex)
				{
					die("Failed to run query: " . $ex->getMessage());
				}

				$login_ok = false;

				$row = $stmt->fetch();
				if($row)
				{
					$check_password = hash('sha256', $_POST['password'] . $row['salt']);
					for($round = 0; $round < 65536; $round++)
					{
						$check_password = hash('sha256', $check_password . $row['salt']);
					}

					if($check_password === $row['password'])
					{
						$login_ok = true;
					}
				}

				if($login_ok)
				{
					unset($row['salt']);
					unset($row['password']);

					$_SESSION['user'] = $row;

					header("Location: admin.php");
					die("Redirecting to: admin.php");
				}
				else
				{
					$correction = 'block';

					$submitted_email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');

					header("Location: login.php");
					die("Redirecting to: login.php");
				}
			}
		}
	}
	login();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="Prefects Cup">
		<meta name="author" content="Matthew Wang">
		<title>Login | Prefects Cup</title>
		<link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/base.css" rel="stylesheet" />
		<link href="css/font-awesome.min.css" rel="stylesheet" />
	</head>
  <body>
  	<div class="container">
  		<h1>Account Login</h1>
  		<h3>Don't have an account? <b><a href="mailto:matthew.wang@ucc.on.ca">Contact Matthew Wang</a></b>.</h3>
  		<form class="form-signin" action="?login" method="post">
  			<div class="row pt-2">
  				<div class="col-md-12">
  					<input type="email" id="email" class="form-control" placeholder="john.smith@ucc.on.ca" name="email" required="" autofocus="">
  				</div>
  			</div>
  			<div class="row pt-2">
  				<div class="col-md-12">
  					<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
  				</div>
  			</div>
  			</br>
  			<div class="row pt-2">
  				<div class="col-md-12">
  					<button class="btn btn-lg btn-primary btn-block" type="submit" value="Login">Login</button>
  				</div>
  			</div>
  		</form>
  	</div>
		<footer class="text-center">
      <div class="container">
        <p><span class="text-muted">Made by Matthew Wang with <span class="fa fa-heart" style="color:red;"></span> and <a href="http://github.com/malsf21/prefects-cup-website"><span class="fa fa-github" style="color:black;"></span></a></span></p>
      </div>
    </footer>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/google_analytics.js"></script>
  </body>
</html>
