<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<!-- partial:index.partial.html -->
<div class="student-login-container">
<div class="box-form">
	<div class="left">
		<div class="overlay">
		<div class="image-wrapper">
			<img src="<?php echo URLROOT . 'img/logo-icon.png' ?>" alt="image">
		</div>
		<h1>Hello There!</h1>
		
	</div>
</div>
	
	
		<div class="right">
		<h5>Login</h5>
        <form action="<?php echo URLROOT; ?>login/student-login" method="POST" class="display-flex-col">
		<div class="inputs">
			<input type="email" placeholder="Email" name="email">
			<br>
			<input type="password" placeholder="password" name="password"> 
		</div>
		<div class="main-signin-error-hide <?php echo $data['error_class']; ?>">
                    <span class="material-symbols-rounded">
                    report
                    </span>
                    <?php echo $data['error_msg']; ?>
        </div>
    
		<br><br>
			
			<button class="login-btn" type="submit">Login</button>
			</form>
	</div>
	
</div>
</div>
<!-- partial -->
  
<?php require APPROOT . '/views/includes/footer.php'; ?>
