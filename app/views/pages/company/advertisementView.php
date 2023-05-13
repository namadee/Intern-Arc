<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="advertisement_page" class="main-content advertisement-main-content">
    <?php flashMessage('student_request_msg'); ?>
    <?php flashMessage('max_application'); ?>

    <div class="advertisement-main-container">
        <div class="ad-header">
            <div class="display-flex-row ad-header-top">
                <img class="ucsc-logo" src="<?php echo URLROOT ?>img/ucsc-logo.png">
                <!-- <h1>University of Colombo School Of Computing</h1> -->
                <!-- <img class="internarc-logo" src="<?php echo URLROOT ?>img/logo.png"> -->

                <div class="display-flex-col ad-header-bottom">
                    <h1>University of Colombo School Of Computing</h1>
                    <h2>UCSC INDUSTRIAL PLACEMENTS-2024</h2>
                    <h3>Placement Advertisement</h3>
                </div>
            </div>
        </div><br><br>

        <div class=" display-flex-row advertisement-container-body">
            <div class="body-left">
                <ul class="display-flex-col">
                    <li class="display-flex-row">
                        <p class="profile-item">Company</p>
                        <span></span>
                    </li>
                    <li class="display-flex-row">
                        <p class="profile-item">Position</p>
                        <span><?php echo $data['position'] ?></span>
                    </li>
                    <li class="display-flex-row">
                        <p>No of Interns</p>
                        <span><?php echo $data['no_of_interns'] ?></span>
                    </li>
                    <li class="display-flex-row">
                        <p>Applicable for</p>
                        <span><?php echo $data['required_year'] ?></span>
                    </li>
                    <li class="display-flex-row">
                        <p>Working Mode</p>
                        <span><?php echo $data['working_mode'] ?></span>
                    </li><br><br>
                    <li class="display-flex-col period">
                        <h3>Internship Period</h3>
                        <div class="display-flex-row period-items">
                            <span><?php echo $data['internship_start']  ?></span>
                            <span><?php echo $data['internship_end'] ?></span>
                        </div>

                    </li>

                </ul>
            </div>


            <div class="body-right">
                <div class="display-flex-col job-description">
                    <h3>Job Description</h3><br>
                    <div class="display-flex-col job-description-items">
                        <p><?php echo $data['job_description'] ?></p>
                    </div>
                </div><br>
                <div class="display-flex-col job-description">
                    <h3>Requirements</h3><br>
                    <div class="display-flex-col job-description-items">
                        <p><?php echo $data["requirements"] ?></p>
                    </div>
                </div>
            </div>

        </div>
        <a href="<?php
                    if ($_SESSION['user_role'] == 'company') {
                        echo URLROOT . 'requests/showRequestsByAd/' . $data['advertisement_id'];
                    } else if ($_SESSION['user_role'] == 'student') {
                        echo URLROOT . 'requests/addStudentRequest/' . $data['advertisement_id'];
                    } ?>" class="common-blue-btn apply-btn"><?php echo $data['button_name'] ?></a>
    </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>