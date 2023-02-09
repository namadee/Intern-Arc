<?php require APPROOT . '/views/includes/header.php'; ?>

<section class="forgot-pword-container display-flex-row">
    <?php flashMessage('verification_code_invalid'); ?>
    <div class="display-flex-col forgot-pword-rightbox verification-main-container">
        <form action="<?php echo URLROOT . "login/verify-password" ?>" class="display-flex-col forgot-pwd-form pwd-verification-form" method="POST">
            <ul class="display-flex-row">
                <li>
                    <img src="<?php echo URLROOT . "img/verification-pending.svg" ?>">
                </li>


                <li class="display-flex-col">
                    <label for="verification-code">We have sent the verification code to <br /> <span id="email-span"> <?php echo $data['email']; ?> </span><br /> Enter the received Verification Code below!</label>
                    <div class="display-flex-row">
                        <span class="material-symbols-outlined">
                            key
                        </span>
                        <input type="number" name="verification_code" id="verification_code" class="common-input" required maxlength="6">

                    </div>
                    <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
                    <button type="submit" class="common-blue-btn">Submit</button>
                </li>
            </ul>


        </form>
    </div>


</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>