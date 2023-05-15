<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/company.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>


<section class="update-pwd-container change-password-container">
<?php flashMessage('password_changed_error'); ?>

    <h2>Change your Password</h2>
    <form action="<?php echo URLROOT; ?>companies/changePassword" class="display-flex-col" method="POST" id="change_password_pdc">
        <ul class="display-flex-col update-pwd-list">
        <li class="display-flex-row">
                <label for="old_password">Old Password</label>
                <input type="password" name="user_old_password" id="user_old_password" class="common-input" required>
                <span class="material-symbols-outlined" id="toggleIconChangePwd">
                    visibility_off
                </span>
            </li>    
        <li class="display-flex-row">
                <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
                <label for="password">New Password</label>
                <input type="password" name="user_new_password" id="user_new_password" class="common-input" required min="6">
            </li>
            <li class="display-flex-row">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="user_confirm_password" id="user_confirm_password" class="common-input" required min="6">
            </li>
            <li id="changePwd_validate_error"></li>
        </ul>
        <button class="common-blue-btn">Submit</button>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

    </form>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>