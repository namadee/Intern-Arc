<?php require APPROOT . '/views/includes/header.php'; ?>

<section class="forgot-pword-container display-flex-row">
    <div class="forgot-pword-leftbox">

        <img src="<?php echo URLROOT . "img/forgot-pword-img.svg" ?>">
    </div>

    <div class="display-flex-col forgot-pword-rightbox">
        <?php flashMessage('email_notfound'); ?>
        <form action="<?php echo URLROOT . "login/forgot-password" ?>" method="POST" class="display-flex-col forgot-pwd-form">
            <h1>Forgot Your Password? </h1>
            <ul class="display-flex-col">
                <li class="display-flex-col">
                    <label for="email">Enter your registered email address and we will send you a verification code</label>
                    <input type="email" name="email" id="email" class="common-input" required>
                </li>
            </ul>
            <button type="submit" class="common-blue-btn">Send Code</button>
        </form>
    </div>


</section>



<?php require APPROOT . '/views/includes/footer.php'; ?>