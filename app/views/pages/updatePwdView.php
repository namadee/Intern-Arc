<?php require APPROOT . '/views/includes/header.php'; ?>

</head>

<section class="update-pwd-container">
    <h2>Add your New Password</h2>
    <form action="<?php echo URLROOT; ?>users/update-password" class="display-flex-col" method="POST">
    <?php flashMessage('verification_code_success'); ?>
        <ul class="display-flex-col update-pwd-list">
            <li class="display-flex-row">
                <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" class="common-input" required>
                <span class="material-symbols-outlined" id="togglePasswordIcon1">
                    visibility
                </span>
            </li>
            <li class="display-flex-row">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="common-input" required>
                <span class="material-symbols-outlined" id="togglePasswordIcon2">
                    visibility
                </span>
            </li>
            <li id="pwd-validate-error"></li>
        </ul>
        <button class="common-blue-btn">Submit</button>


    </form>
</section>



<?php require APPROOT . '/views/includes/footer.php'; ?>