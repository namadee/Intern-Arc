<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="profile_page" class="main-content profile-main-content company_profile_view">
    <?php flashMessage('profile_update_status'); ?>
    <div class="profile-main-container">
        <div class="profile-left">
            <div>
                <div class="profile-left-top">
                    <h2>Company Profile</h2>
                    <a href="<?php echo $data['linkedlnUrl']; ?>" target="_blank">
                        <img src="<?php echo URLROOT . 'img/linkedIn_icon.png' ?>">
                    </a>

                </div>

                <img class="profileImg" src="<?php echo URLROOT . $data['image'] ?>">
                <div class="profile-left-text">
                    <h1>Welcome To <span class="orange-text"><?php echo $data['company_name'] ?></span></h1>
                    <p class="orange-text"><?php echo $data['company_slogan'] ?></p><br>
                    <p class="display-flex-row item">
                        <a class="display-flex-row" href="mailto:<?php echo $data['company_email']; ?>">
                            <span class="material-symbols-outlined icon-profiles">
                                mail
                            </span> <?php echo $data['company_email'] ?>
                        </a>
                    </p>
                </div>
            </div>

            <div class="profile-bottom">
                <div class="display-flex-row item">
                    <span class="material-symbols-outlined icon-profiles">location_on</span>
                    <p><?php echo $data['company_address'] ?></p>
                </div>
                <div class="display-flex-row item">
                    <span class="material-symbols-outlined icon-profiles">
                        call
                    </span>
                    <p><?php echo $data['contact']; ?></p>
                </div>
                <div>
                    <a style="display: <?php echo $data['edit_button_class']; ?>;" class="common-blue-btn" id="company-edit-btn" href="<?php echo URLROOT; ?>profiles/update-company-profile"><span class="material-symbols-outlined ">edit_square</span> Edit Profile</a>
                </div>
            </div>

        </div>
        <div class="profile-right display-flex-col">
            <p class="description">
                <?php echo $data['company_description'] ?>
            </p>

            <button class="profile-btn">
                <a href="<?php echo $data['websiteLink'] ?>">
                    Visit Website
                </a>
            </button>

        </div>

    </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>