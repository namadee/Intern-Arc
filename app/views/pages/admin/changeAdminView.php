<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>


<section class="update-pwd-container change-password-container">
    <?php flashMessage('adminRegMsg'); ?>

    <h2>Add Administrator</h2>
    <form action="<?php echo URLROOT; ?>admin/changeAdmin" class="display-flex-col" method="POST" id="changeAdmin" onsubmit="return confirm('Please note that once submitted, the action cannot be reversed. Continue?');">
        <ul class="display-flex-col update-pwd-list">
            <li class="display-flex-row">
                <label for="newAdminUsername">New Admin Username</label>
                <input type="text" name="username" id="newAdminUsername" class="common-input" required min="6">
            </li>
            <li class="display-flex-row">
                <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
                <label for="newAdminEmail">New Admin Email</label>
                <input type="email" name="email" id="newAdminEmail" class="common-input" required>
            </li>
            <li id="changeAdmin_error"></li>
        </ul>
        <button class="common-blue-btn">Submit</button>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
    </form>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>