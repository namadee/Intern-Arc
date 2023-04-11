<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="advertisement_page" class="main-content advertisement-main-content">
    <?php flashMessage('student_request_msg'); ?> 
    <div class="advertisement-main-container">
        <div class="ad-header">
            <div class="display-flex-row ad-header-top">
                <img class="ucsc-logo" src="<?php echo URLROOT ?>img/ucsc-logo.png">
                <h1>University of Colombo School Of Computing</h1>
                <img class="internarc-logo" src="<?php echo URLROOT ?>img/logo.png">
            </div>
            <div class="display-flex-col ad-header-bottom">
                <h2>UCSC INDUSTRIAL PLACEMENTS-2024</h2>
                <h3>Placement Advertisement</h3>
            </div>
        </div><br><br>
        
       <div class=" display-flex-row advertisement-container-body">
        <div class="body-left">
            <ul class="display-flex-col">
                    <li class="display-flex-row">
                        <p class="profile-item">Company Name</p>
                        <span>Virtusa</span>
                    </li>
                    <li class="display-flex-row">
                        <p class="profile-item">Position</p>
                        <span>Software Engineering Intern</span>
                    </li>
                    <li class="display-flex-row">
                        <p>No of Interns</p>
                        <span>15</span>
                    </li>
                    <li class="display-flex-row">
                        <p>Applicable for</p>
                        <span>4th year</span>
                    </li>
                    <li class="display-flex-row">
                        <p>Working Mode</p>
                        <span>On site</span>
                    </li><br><br>
                    <li class="display-flex-col period">
                        <h3>Internship Period</h3>
                        <div class="display-flex-row period-items">
                            <span>2023.10.06</span>
                            <span>2024.02.06</span>
                        </div>
                        
                    </li>
                    
                </ul> 
            </div>
       

        <div class="body-right">
            <div class="display-flex-col job-description">
                    <h3>Job Description</h3><br>
                    <div class="display-flex-col job-description-items">
                        <p>We are looking for self-motivated, dedicated and fun-loving team players to be a part of our culture and gain eal-world experience in software engineering with our professionals</p>
                    </div>
            </div><br>
            <div class="display-flex-col job-description">
                    <h3>Requirements</h3><br>
                    <div class="display-flex-col job-description-items">
                        <p>Strong understanding of computer science fundamentals, including algorithms and data structures <br/> Experience with at least one programming language, such as Python, Java, C++, or Ruby</p>
                    </div>
            </div>
       </div>
       
       </div>
        <a href="<?php 
            if($_SESSION['user_role'] == 'company'){
                echo URLROOT . 'requests/showRequestsByAd/'.$data['advertisement_id'];
            }else if($_SESSION['user_role'] == 'student'){
                echo URLROOT . 'requests/addStudentRequest/' . $data['advertisement_id'];


            } ?>" class="common-blue-btn apply-btn"><?php echo $data['button_name'] ?></a>
    </div> 

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>
