<?php require APPROOT . '/views/includes/company_header.php'; ?>
<div class="loginContainer">
        <div class="leftBox">
            <h1>Login</h1>
            <form id="loginForm" action="">
               
                <input type="text" id="userName" name="userName" placeholder="User Name">
            
                
                <input type="password" id="pword" name="pword" placeholder="PassWord">
                <br>
                <a href="#">Forgot your Password?</a>
                <br>
               
                
                <input type="submit" value="Login">
              </form>
        </div>
        <div class="rightBox">
            <img src="images/logo 1.png">
            <h1>Hello There!</h1>
        </div>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>