<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Reddit Clone</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
	<meta name="description" content="Reddit" />
	<link rel="shortcut icon" href="images/favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="styles/style.css" />

    <script>
        function validate(){
			var email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(document.getElementById("reg-pw").value != document.getElementById("reg-confirm-pw").value) {
				$(document).ready(function() {
					$("#reg-confirm-pw").effect("shake");
				});
                return false;
            } else if (!email_regex.test(document.getElementById("reg-email").value)) {
				$("#reg-email").effect("shake");
				return false;
			}
            return true;
       }
	   $(document).ready(function() {
		   $('#reg-pw, #reg-confirm-pw').on('keyup', function () {
			   if ($('#reg-pw').val() == $('#reg-confirm-pw').val()) {
				   // $('#message').html('Matching').css('color', 'green');
				   $('#reg-confirm-pw').animate({backgroundColor: '#00FF00'}, 'fast');
			   } else {
				   $('#reg-confirm-pw').animate({backgroundColor: '#FFF'}, 'fast');
			   }
		   });
	   });
	</script>
	<?php
	session_start();
	// this will trigger when submit button click
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['sign-in'])){
        $link = mysqli_connect("localhost", "st2014", "progress", "st2014");
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $username = mysqli_real_escape_string($link, $_POST['loginusername']);
        $password = mysqli_real_escape_string($link, $_POST['loginpw']);
		// create query
		$query = "SELECT * FROM t164053_users WHERE username='$username' AND password='$password'";
		$sql = $link->query($query);
		$n = $sql->num_rows;
		// if $n is > 0 it mean account exists
		if($n > 0){
		    $_SESSION['uname'] = $username;
		    $_SESSION['logged_in'] = true;
			header('Location: index.php');
		} else {
			//echo "alert(Incorrect username or password.)";
			echo '<script>
			$(document).ready(function() {
				$("#register-form").effect("shake")
			});
			</script>';
		}
	}
	?>

</head>

<body>
    <div class="navbar">
		<div id="logo">
			<a href="#">
				<img src="images/logo.png">
			</a>
		</div>
		<?php
		if (isset($_SESSION['logged_in'])) {
			echo '<div class="logged-in"><a id="signup-btn"><table id="logged-in-options"><tr>
								<th><a href="submit.php"><button id="sign-in" class="btnblue" type="submit" class="button">Submit new post</button></a></th>
								<th><a href="logout.php"><button id="sign-in" class="btnblue" type="submit" class="button">Log out</button></a></th></tr></table></a></div>';
		} else {
			echo '<div class="logged-in"><a id="signup-btn"><table id="logged-in-options"><tr>
								<th><a href="signup.php"><button id="sign-in" class="btnblue" type="submit" class="button">Sign in or create an account</button></a></th></tr></table></a></div>';
		}
		?>
  	</div>

    <div class="split-pane">
        <h1>Create a new account</h1>
        <form class="register-form" onSubmit="return validate()" action="dbregister.php" method="POST">
            <input id="reg-username" type="text" placeholder="pick a username" name="username" style="width=200px">
            <input id="reg-fullname" type="text" placeholder="enter your full name" name="fullname">
            <input id="reg-pw" type="password" placeholder="password" name="password">
            <input id="reg-confirm-pw" type="password" placeholder="confirm password" name="confirm-pw">
            <input id="reg-email" type="text" placeholder="email" name="email"><br>
            <button type="submit" class="btnblue" id="sign-up-in-btn" value="Sign up"> Sign up</button>
        </form>
    </div>
    <div class="split-pane">
        <h1>or just sign into an existing one.</h1>
        <form class="register-form" id="register-form" method="POST" >
            <input id="login-username" type="text" placeholder="username" name="loginusername">
            <input id="login-pw" type="password" placeholder="password" name="loginpw"><br>
            <button type="submit" class="btnblue" id="sign-up-in-btn" value="Sign in" name="sign-in"> Sign in</button>
        </form>
    </div>
</body>
</html>
