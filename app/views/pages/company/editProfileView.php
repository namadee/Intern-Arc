<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="profile_page" class="main-content profile-main-content">
    <?php flashMessage('profile_update_status');
            flashMessage('adminRegMsg');

    ?>
    <div class="edit-profile-main-container">
        <!-- <a class="common-blue-btn" id="company-edit-btn" href="<?php echo URLROOT; ?>profiles/update-company-profile"><span class="material-symbols-outlined ">edit_square</span> Edit Profile</a> -->

        <form id="editCompanyPofile" method="POST" action="<?php echo URLROOT . 'profiles/update-company-profile' ?>" enctype="multipart/form-data">
            <div class="edit-company-Profile">
                <div>
                    <div class="profile-left-top">
                        <h2>Company Profile</h2>

                    </div>
                    <img class="profileImg" src="<?php echo URLROOT . $data['image'] ?>"><br>

                    <label for="profile_image" class="common-blue-btn" id="company-edit-btn">
                        <input type="file" onchange="displayImageName(this.files[0].name)" id="profile_image" name="profile_image" accept=".png , .jpg ,.jpeg"> Upload Image
                    </label><br>
                    <small class="file-info text-muted"></small>
                    <br><br><br>
                    <div class="profile-left-text">
                        <p>Company Name: <input class="common-input" type="text" name="company_name" id="company_name" placeholder="Company Name" value="<?php echo $data['company_name'] ?>"></p><br>
                        <div>
                            <p>Company Slogan: </p>
                            <textarea style="resize: none;" class="common-input" rows="3" cols="50" name="company_slogan" id="company_slogan" placeholder="Company tagline"><?php echo $data['company_slogan'] ?></textarea><br>

                        </div>
                        <br>
                        <p>Email: <input class="common-input" type="email" name="company_email" id="company-email" placeholder="email address" value="<?php echo $data['company_email'] ?>"></p><br>
                        <div class="display-flex-col">Description:
                            <textarea style="resize: none;" class="common-input" name="company_description" id="company_description" placeholder="Company description" rows="5" cols="50"><?php echo $data['company_description'] ?></textarea><br>

                        </div>
                    </div>
                </div>

                <div class="profile-bottom">
                    <div class="display-flex-row">
                        Company Address
                        <span class="material-symbols-outlined">location_on</span>
                        <input type="text" class="common-input" name="company_address" id="company_address" placeholder="address" value='<?php echo $data['company_address'] ?>'>
                    </div>

                    <div class="addBtn">
                        <button class="common-blue-btn" type="submit">Save</button>
                    </div>
                </div>

            </div>

        </form>
    </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>