<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>


<section id="update-main-profile" class="main-content">
    <?php flashMessage('profile_update_status'); ?>
    <?php flashMessage('password_changed'); ?>

    <div class="update-profile-container display-flex-col">
        <h2>Profile Details</h2>

        <form class="display-flex-col" method="POST" action="<?php echo URLROOT . "profiles/update-profile-details" ?> " enctype="multipart/form-data">
            <div class="main-user-profile-icon display-flex-col">
                <div class="display-flex-col">
                    <img src="<?php echo URLROOT . $_SESSION['profile_pic']; ?>">
                    <label for="upload-img" id="main-profile-edit" class="display-flex-row">
                        <span class="material-symbols-outlined">
                            edit_square
                        </span>
                        Change</label>
                    <input type="file" name="upload_img" id="upload-img">
                </div>
                <p id="form-file-name"></p>
            </div>
            <ul>
                <li>
                    <label for="username">Name</label>
                    <input class="common-input" type="text" id="username" name="username" placeholder="Name" value="<?php echo $data['username']; ?>">
                </li>
                <li>
                    <label for="email">Email</label>
                    <input class="common-input" type="email" id="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>">
                </li>
            </ul>
            <div class="update-profile-container-btn">
                <button class="common-blue-btn" type="submit">Update</button>
                <button class="common-blue-btn display-flex-row" type="reset" id="reset-btn"><span class="material-symbols-outlined">
                        restart_alt
                    </span>Reset</button>
            </div>
        </form>
        <button id="secondary-grey-btn" onclick="window.location.href='<?php echo URLROOT . "pdc/change-password" ?>'">Change Password? Press here</button>



    </div>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>