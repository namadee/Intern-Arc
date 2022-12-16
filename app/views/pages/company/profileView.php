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
                <p class="orange-text">Sparking innovation, one sprint at a time.</p><br>
                <p>Eshtablished Date: 2000-08-08</p>
                <p>Company Adress: Colombo</p>
                <p>Description: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam ullam vel ad nobis culpa, expedita quidem labore, eos facilis, excepturi unde placeat soluta id. Dignissimos enim nulla sed sunt assumenda.</p>
                <p>email: virtusa123@gmail.com</p>
            </div>

            <div class="profile-bottom">
                <span class="material-symbols-outlined">location_on</span>
                <p>752 , Dr Danister De Silva Mawatha, Colombo 09</p>
            </div>   

        </div>
        <div class="profile-right">
            <p class="description">
           Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam laboriosam odit dolores soluta dolorem. Officia eaque, esse ipsam aliquam deleniti rem molestiae laborum corporis laboriosam id, harum architecto qui excepturi?
            </p>

            <button class="profile-btn" >Visit Website</button>

        </div>

    </div> 

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>
