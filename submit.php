<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Reddit Clone</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
	<meta name="description" content="Reddit" />
	<link rel="shortcut icon" href="images/favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="styles/style.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div class="navbar">
		<div id="logo">
			<a href="#">
				<img src="images/logo.png">
			</a>
		</div>
		<?php
        session_start();
		if (isset($_SESSION['logged_in'])) {
            echo '<div class="logged-in"><a id="signup-btn"><table id="logged-in-options"><tr><th><a href="submit.php"><button id="sign-in" class="btnblue" type="submit" class="button">Submit new post</button></a></th>';
			echo '<th><a href="logout.php"><button id="sign-in" class="btnblue" type="submit" class="button">Log out</button></a></th></tr></table></a></div>';
		} else {
            header("location: signup.php");
			echo '<div id="right-side-opts"><a id="signup-btn"><form action="signup.php">
				<button id="sign-in" class="btnblue" type="submit" class="button">Sign in or create an account</button>
			</form></a></div>';
		}
		?>
  	</div>

    <div class="split-pane">
        <h1>Create a new post</h1>
        <form class="register-form" method="POST">
            <input id="post-title" type="text" placeholder="title" name="title">
            <textarea id="post-content" type="text" placeholder="text" name="content"></textarea>
            <!--<input id="post-subreddit" type="text" placeholder="subreddit" name="subreddit">-->
            <button type="submit" class="btnblue" id="sign-up-in-btn" value="Sign up" name="submit-post">Submit post</button>
        </form>
		<div id="failure"></div>
		<?php
    	// this will trigger when submit button click
    	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit-post'])){
            $link = mysqli_connect("", "", "", "");
            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            // Escape user inputs for security
            $username = $_SESSION['uname'];
            $title = mysqli_real_escape_string($link, $_REQUEST['title']);
            $content = mysqli_real_escape_string($link, $_REQUEST['content']);
            // $subreddit = mysqli_real_escape_string($link, $_REQUEST['subreddit']);
			$subreddit = 'all';
            $posttype = '1';
			if ($title === '' || $content === '') {
				echo '<script>document.getElementById("failure").innerHTML = "<p>Title or post content not entered.</p>";</script>';
			} else {
	            // attempt insert query execution
	            $sql = "INSERT INTO t164053_news (username, news, type, subreddit, title) VALUES ('$username', '$content', '$posttype', '$subreddit', '$title')";
	            if(mysqli_query($link, $sql)) {
	                // echo "Records added successfully.";
	                $msg = 'Post submitted successfully!';
	                echo "<script> window.location.assign('index.php'); </script>";
	            } else {
	                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	            }
			}
    	}
    	?>
    </div>
</body>
</html>
