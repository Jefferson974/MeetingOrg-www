


<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<section class="top">
		<div id="logo">
			<img class ="logoLogin" src="..\images\logo transparent.png" height="120px">
		</div>
	</section>
  <section class="container">
    <div class="login">
      <h1>Login to Meeting Organizer
	  </h1>
     
  <!--       <p><input type="text" name="login" value="" ></p>
        <p><input type="password" name="password" value="" ></p>
         -->
<?php include('_header.php'); ?>

<form method="post" action="index.php" name="loginform">
    <label for="user_name"><?php echo WORDING_USERNAME; ?></label>
    <input id="user_name" type="text" name="user_name" placeholder="Username or Email" required />
    <label for="user_password"><?php echo WORDING_PASSWORD; ?></label>
    <input id="user_password" type="password" name="user_password" autocomplete="off" placeholder="Password" required />
    <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
    <label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
    <input type="submit" name="login" value="<?php echo WORDING_LOGIN; ?>" />
</form>

<a style="color:black" href="register.php"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></a>
<a style="color:black" href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>

<?php include('_footer.php'); ?>


  
    </div>

  </section>

</body>
</html>


