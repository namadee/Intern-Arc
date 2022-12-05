<!DOCTYPE html>
<html>

<head>
	<title>Admin Login Form</title>
	<link rel="stylesheet" href="<?php echo URLROOT; ?>css/shared.css">
	<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

	<div class="container">
	<div>
		<img src="<?php echo URLROOT . 'img/logo-icon.png' ?>" alt="Intern Arc Logo">

	</div>
		<div class="login-content">
			<form action="index.html">
				<h2 class="title">Welcome Intern Arc</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<input type="text" class="input" placeholder="Username">
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<input type="password" class="input" placeholder="Password">
					</div>
				</div>
				<a href="#">Forgot Password?</a>
				<input type="submit" class="btn" value="Login">
			</form>
		</div>
	</div>
</body>

</html>