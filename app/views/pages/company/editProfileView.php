<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="profile_page" class="main-content profile-main-content"> 
    <div class="edit-profile-main-container">
        
    <form id="editCompanyPofile" action="<?php echo URLROOT. $data['formAction']; ?>" method="POST">
        <div class="edit-company-Profile">
            <div>
            <div class="profile-left-top">
                <h2>Company Profile</h2>
                <img src="<?php echo URLROOT . 'img/linkedIn_icon.png' ?>">
            </div>
            <img class="profileImg" src="<?php echo URLROOT . 'img/profile-img/profile-icon.svg' ?>">
            
            <div class="profile-left-text">
                <p><input type="text" name="company_name" id="company_name" placeholder="Company Name" value="<?php echo $data['company_name'] ?>"></p><br>
                <textarea name="company_slogan" id= "company_slogan" placeholder="Company tagline"><?php echo $data['company_slogan'] ?></textarea><br>
                <p>email: <input type="email" name="company_email" id="company-email" placeholder="email address" value="<?php echo $data['company_email'] ?>"></p><br>

                <textarea name="company_description" id= "company_description" placeholder="Company description" rows="15" cols="100"><?php echo $data['company_description'] ?></textarea><br>
            </div>
            </div>

            <div class="profile-bottom">
                <div class="display-flex-row">
                    <span class="material-symbols-outlined">location_on</span>
                    <input type="text" name="company_address" id="company_address" placeholder="address" value='<?php echo $data['company_address'] ?>'>
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
