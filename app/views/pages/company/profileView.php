<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="profile_page" class="main-content profile-main-content">
    <?php flashMessage('profile_update_status'); ?>
    <div class="profile-main-container">
        <div class="profile-left">
            <div>
                <div class="profile-left-top">
                    <h2>Company Profile</h2>
                    <!-- <h2>Company Profile</h2> -->
                    <img src="<?php echo URLROOT . 'img/linkedIn_icon.png' ?>">
                </div>
                <img class="profileImg" src="<?php echo URLROOT . $data['image'] ?>">

                <div class="profile-left-text">
                    <h1>Welcome To <span class="orange-text"><?php echo $data['company_name'] ?></span></h1>
                    <p class="orange-text"><?php echo $data['company_slogan'] ?></p><br>
                    <p>Email: <?php echo $data['company_email'] ?></p>
                </div>
            </div>

            <div class="profile-bottom">
                <div class="display-flex-row">
                    <span class="material-symbols-outlined">location_on</span>
                    <p><?php echo $data['company_address'] ?></p>
                </div>

                <div>
                    <a style ="display: <?php echo $data['edit_button_class']; ?>;" class="common-blue-btn" id="company-edit-btn" href="<?php echo URLROOT; ?>profiles/update-company-profile"><span class="material-symbols-outlined ">edit_square</span> Edit Profile</a>
                </div>
            </div>

        </div>
        <div class="profile-right display-flex-col">
            <p class="description">
                <?php echo $data['company_description'] ?>
            </p>

            <button class="profile-btn">Visit Website</button>

        </div>

    </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>