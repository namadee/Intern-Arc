<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="profile_page" class="main-content profile-main-content"> 
    <div class="profile-main-container">
        <div class="profile-left">
            <div class="profile-left-top">
                <h2>Company Profile</h2>
                <img src="<?php echo URLROOT . 'img/linkedIn_icon.png' ?>">
            </div>
            <img class="profileImg" src="<?php echo URLROOT . 'img/profile-img/profile-icon.svg' ?>">
            <div class="profile-left-text">
                <h1>Welcome To <span class="orange-text">Virtusa</span></h1>
                <p class="orange-text">Sparking innovation, one sprint at a time.</p>
                <p>Eshtablished Date: 2000-08-08</p>
            </div>

            <div class="profile-bottom">
                <span class="material-symbols-outlined">location_on</span>
                <p>752 , Dr Danister De Silva Mawatha, Colombo 09</p>
            </div>   

        </div>
        <div class="profile-right">
            <p class="description">
            Virtusa help clients change, disrupt, and unlock new value that surpasses 
            their wildest expectations not just to reach our best, but to redefine yours.
            </p>

            <button class="profile-btn" >Visit Website</button>

        </div>

    </div> 

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>
