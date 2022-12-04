<?php require APPROOT . '/views/includes/header.php'; ?>
<div class="loginContainer">
        <div class="leftBox">
            <h1>Login</h1>
            <form id="loginForm" action="<?php echo URLROOT; ?>users/company-login" method="POST">
               
                <input type="email" id="userName" name="email" placeholder="email" required>
            
                
                <input type="password" id="pword" name="password" placeholder="Pass Word">
                <br>
                <a href="#">Forgot your Password?</a>
                <br>
                <div class="signin-error-hide <?php echo $data['error_class']; ?>">
                    <span class="material-symbols-rounded">
                    report
                    </span>
                    <?php echo $data['error_msg']; ?>
                </div>
                
                <input type="submit" value="Login">
              </form>
        </div>
        <div class="rightBox">
            <img src="<?php echo URLROOT . 'img/logo.png' ?>">
            <h1>Hello There!</h1>
        </div>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>