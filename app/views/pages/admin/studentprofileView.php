<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col" id="student-main-profile">
<!-- <?php echo $_SESSION['user_id'] ?>     -->
<div class="student-profile-view display-flex-col">
        <div class="std-profile-container-top display-flex-col">

            <h3>Student Profile</h3> <br/>
            <div class="student-profile-bio display-flex-row">
                <div class="display-flex-col">
                    <h3>Hello! Im <span><?php echo $data['profile_name'] ?></span></h3>
                    <!-- <p>Award-winning web developer and instructor with 10+ years of well-rounded experience in LAMP development, object-oriented and user-centered design, seeks a position with a top technology firm.</p> -->
                    <?php echo $data['profile_description'] ?>
                </div>
            </div>
        </div>
        <div class="std-profile-container-body display-flex-row">
            <div class="body-left display-flex-row">
                <ul class="display-flex-col">
                    <li class="display-flex-row">
                        <p class="profile-item">Stream</p>
                        <span><?php echo $data['stream'] ?></span>
                    </li>
                    <li class="display-flex-row">
                        <p>Contact</p>
                        <span><?php echo $data['contact'] ?></span>
                    </li>
                    <li class="display-flex-row">
                        <p>School</p>
                        <span><?php echo $data['school'] ?></span>
                    </li>
                    <li class="display-flex-col interested-areas" id="interests">
                        <h3>Interested Areas</h3>
                        <div class="display-flex-row interested-area-items">
                        <?php
                        $text = explode("\n",$data['interests']);
                        $length = count($text);
                        //echo $length;

                        $emptyArray = array();
                        // for ($x = 0; $x < $length; $x++) {
                         
                        //}

                        for($x=0;$x<$length;$x++)
                        {
                            $emptyArray[$x] = trim($text[$x]);
                            ?>
                            <span><?php echo $text[$x] ?></span>
                            <?php
                        }
                        ?>
                            
                    </li>
                    <li class="display-flex-col extra-curricular">
                        <h3>Extra Curricular</h3>

                        <?php
                        $text = explode("\n",$data['extracurricular']);
                        $length = count($text);
                        //echo $length;

                        $emptyArray = array();
                        // for ($x = 0; $x < $length; $x++) {
                         
                        //}

                        for($x=0;$x<$length;$x++)
                        {
                            $emptyArray[$x] = trim($text[$x]);
                            ?>
                            <div class="display-flex-col experience-items">
                                <?php echo $text[$x] ?>
                            </div>
                            <?php
                        }
                        ?>

                    </li>
                </ul> 
            </div>


            <div class="body-right display-flex-col">
                <div class="display-flex-col student-experience">

                <?php if (!empty($data['experience'])): ?>
                <h3>Experience</h3>
                <?php
                        $text = explode("\n",$data['experience']);
                        $length = count($text);
                        //echo $length;

                        $emptyArray = array();
                        // for ($x = 0; $x < $length; $x++) {
                         
                        //}

                        for($x=0;$x<$length;$x++)
                        {
                            $emptyArray[$x] = trim($text[$x]);
                            ?>
                            <div class="display-flex-col experience-items">
                                <?php echo $text[$x] ?>
                            </div>
                            <?php
                        }
                        ?>
                <?php endif; ?>

                    

                </div>
                <div class="display-flex-col student-experience">
                    <h3>Qualifications</h3>

                    <?php
                        $text = explode("\n",$data['qualifications']);
                        $length = count($text);
                        //echo $length;

                        $emptyArray = array();
                        // for ($x = 0; $x < $length; $x++) {
                         
                        //}

                        for($x=0;$x<$length;$x++)
                        {
                            $emptyArray[$x] = trim($text[$x]);
                            ?>
                            <div class="display-flex-col experience-items">
                                <?php echo $text[$x] ?>
                            </div>
                            <?php
                        }
                        ?>
                        
                </div>
            </div>
            <section class="std-profile-image">
                        <img src="<?php echo URLROOT . 'img/profile-image.jpg'; ?>" alt="">
</section>
        </div>

        <div class="std-profile-container-bottom display-flex-row">
            <div class="bottom-left display-flex-row">
                <img src="<?php echo URLROOT . 'img/github-logo.png'; ?>" alt="Github-icon">
                <img src="<?php echo URLROOT . 'img/linkedin-logo.png'; ?>" alt="Linkedin-icon">
                <div class="display-flex-row">
                    <span class="material-symbols-outlined">
                        mail
                    </span>
                    <?php echo $data['personal_email']?>
                </div>
            </div>

            <!-- <div class="bottom-right">
                <a href="<?php echo URLROOT.'students/cvstatus';?>" class="display-flex-row">
                    <span class="material-symbols-outlined">
                        upload
                    </span>
                    upload CV
                </a>

                
            </div>

            <div class="bottom-right">
                <a href="<?php echo URLROOT.'Profiles/edit-student-profile-Details';?>" class="display-flex-row">
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                    edit profile
                </a>

                
            </div> -->

        </div>
    </div>

    

</section>

<!-- <script>
  document.getElementById("addProfileDetails").onsubmit = function(){
    var interests = document.getElementById("interests").value;

    if (!interests) {
      document.getElementById("interests").style.display = "none";
    }

    return false; 
  }
</script> -->


<?php require APPROOT . '/views/includes/footer.php'; ?>