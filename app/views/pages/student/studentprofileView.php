<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">

<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col" id="student-main-profile">
    <?php flashMessage('profile_update_status'); ?>
    <div class="student-profile-view display-flex-col">
        <div class="std-profile-container-top display-flex-col">

            <h3>Student Profile</h3> <br />
            <div class="student-profile-bio display-flex-row">
                <div class="display-flex-col">
                    <h3>Hello! Im <span><?php echo $data['profile_name'] ?></span></h3>
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
                            $text = explode(", ", $data['interests']);
                            $length = count($text);

                            $emptyArray = array();
                            for ($x = 0; $x < $length; $x++) {
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
                        $text = explode("\n", $data['extracurricular']);
                        $length = count($text);
                        

                        $emptyArray = array();

                        for ($x = 0; $x < $length; $x++) {
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

                    <?php if (!empty($data['experience'])) : ?>
                        <h3>Experience</h3>
                        <?php
                        $text = explode(", ", $data['experience']);
                        $length = count($text);
                        //echo $length;

                        $emptyArray = array();
                        // for ($x = 0; $x < $length; $x++) {

                        //}

                        for ($x = 0; $x < $length; $x++) {
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
                    $text = explode("\n", $data['qualifications']);
                    $length = count($text);
                    //echo $length;

                    $emptyArray = array();
                    // for ($x = 0; $x < $length; $x++) {

                    //}

                    for ($x = 0; $x < $length; $x++) {
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
                <img src="<?php echo URLROOT . $data['image']; ?>" alt="">
            </section>
        </div>

        <div class="std-profile-container-bottom display-flex-row">
            <div class="bottom-left display-flex-row">

                <?php
                $gitlink = $data['github_link'];

                // Check if the link starts with "http://" or "https://"
                if (!preg_match("~^(?:f|ht)tps?://~i", $gitlink)) {
                    // If it doesn't, add "https://" to the beginning of the link
                    $gitlink = "https://" . $gitlink;
                }
                ?>
                <a href="<?php echo $gitlink; ?>" target=blank>
                    <img src="<?php echo URLROOT . 'img/github-logo.png'; ?>" alt="Github-icon">
                </a>

                <?php
                $inlink = $data['linkedin_link'];

                // Check if the link starts with "http://" or "https://"
                if (!preg_match("~^(?:f|ht)tps?://~i", $inlink)) {
                    // If it doesn't, add "https://" to the beginning of the link
                    $inlink = "https://" . $inlink;
                }
                ?>
                <a href="<?php echo $inlink; ?>" target=blank>
                    <img src="<?php echo URLROOT . 'img/linkedin-logo.png'; ?>" alt="Linkedin-icon">
                </a>

                <div class="display-flex-row">
                    <span class="material-symbols-outlined">
                        mail
                    </span>
                    <?php echo $data['personal_email'] ?>
                </div>
            </div>

            <div class="bottom-right">
                <a href="<?php echo URLROOT . 'students/uploadCV'; ?>" class="display-flex-row">
                    <span class="material-symbols-outlined">
                        upload
                    </span>
                    upload CV
                </a>


            </div>

            <div class="bottom-right">
                <a href="<?php echo URLROOT . 'Profiles/edit-student-profile-Details'; ?>" class="display-flex-row">
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                    edit profile
                </a>


            </div>

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