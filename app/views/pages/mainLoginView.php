<?php require APPROOT . '/views/includes/header.php'; ?>
</head>

<body>
<!-- <div class="success-alert" id="flash-message">Password is successfully Changed!</div> -->
    <div class="loginContainer">
        <div class="rightBox">

            <h1>Hello there!</h1>
            <img src="<?php echo URLROOT . 'img/logo.png' ?>">
            <p>Welcome to InternArc</p>
        </div>
        <div class="leftBox">
            <div class="leftBox-innerContainer">
            <?php flashMessage('password_updated'); ?>
                <h1>Login</h1>
                <form id="loginForm" class="display-flex-col" action="<?php echo URLROOT; ?>login" method="POST">

                    <input class="common-input <?php echo $data['input_class']; ?>" type="email" id="userName" name="email" placeholder="Enter your email" required>


                    <input class="common-input <?php echo $data['input_class']; ?>" type="password" id="pword" name="password" placeholder="Enter your password" required>

                    <a href="<?php echo URLROOT . 'users/forgot-password' ?>">Forgot your Password?</a>

                    <input type="submit" value="Login">
                </form>
            </div>


            <div class="<?php echo $data['error_class']; ?>">
                <span class="material-symbols-rounded">
                    report
                </span>
                <?php echo $data['error_msg']; ?>
            </div>
        </div>



    </div>
    <?php require APPROOT . '/views/includes/footer.php'; ?>