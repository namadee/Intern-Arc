<?php require APPROOT . '/views/includes/header.php'; ?>

<section class="forgot-pword-container display-flex-row">
    <div class="forgot-pword-leftbox">
      
    <img src="<?php echo URLROOT. "img/forgot-pword-img.svg" ?>">
    </div>
    <form action="" method="POST" class="display-flex-col forgot-pword-rightbox">
    <h1>Forgot Your Password? </h1> 
                <ul class="display-flex-col">
                    <li class="display-flex-col">
                        <label for="company-name">Enter your email adress we will send you a verification code</label>
                        <input type="email" name="email" id="email" class="common-input" required>
                    </li>
                </ul>
                <button type="submit" class="common-blue-btn">Send Code</button>
    </form>
</section>



<?php require APPROOT . '/views/includes/footer.php'; ?>
