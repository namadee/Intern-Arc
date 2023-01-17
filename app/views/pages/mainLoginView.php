<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
</head>

<body>

    <div class="loginContainer">
        <div class="rightBox">

            <h1>Hello there!</h1>
            <img src="<?php echo URLROOT . 'img/logo.png' ?>">
            <p>Welcome to InternArc</p>
        </div>
        <div class="leftBox">
            <h1>Login</h1>
            <form id="loginForm" class="display-flex-col" action="<?php echo URLROOT; ?>users/company-login" method="POST">

                <input class="common-input" type="email" id="userName" name="email" placeholder="Enter your email" required>


                <input class="common-input" type="password" id="pword" name="password" placeholder="Enter your password" required>

                <a href="#">Forgot your Password?</a>

                <div class="main-signin-error-hide <?php echo $data['error_class']; ?>">
                    <span class="material-symbols-rounded">
                        report
                    </span>
                    <?php echo $data['error_msg']; ?>
                </div>

                <input type="submit" value="Login">
            </form>
        </div>

    </div>
    <?php require APPROOT . '/views/includes/footer.php'; ?>