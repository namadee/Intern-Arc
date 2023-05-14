<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col" id="student-main-profile">
    <div class="student-profile-view display-flex-col">
        <div class="std-profile-container-top display-flex-col">

            <h3>Student Profile</h3>
            <div class="student-profile-bio display-flex-row">
                <div class="display-flex-col">
                    <h3>Hello! Im <span>Ruchira Bogahawatta</span></h3>
                    <p>Award-winning web developer and instructor with 10+ years of well-rounded experience in LAMP development, object-oriented and user-centered design, seeks a position with a top technology firm.</p>
                </div>
            </div>
        </div>
        <div class="std-profile-container-body display-flex-row">
            <div class="body-left display-flex-row">
                <ul class="display-flex-col">
                    <li class="display-flex-row">
                        <p class="profile-item">Stream</p>
                        <span>Information Systems</span>
                    </li>
                    <li class="display-flex-row">
                        <p>Contact</p>
                        <span>0712015054</span>
                    </li>
                    <li class="display-flex-row">
                        <p>School</p>
                        <span>St Joseph's College <br> Colombo</span>
                    </li>
                    <li class="display-flex-col interested-areas">
                        <h3>Interested Areas</h3>
                        <div class="display-flex-row interested-area-items">
                            <span>Machine Learning</span>
                            <span>Dev Ops</span>
                        </div>
                        <div class="display-flex-row interested-area-items">
                            <span>AI</span>
                            <span>Mobile Dev</span>
                        </div>
                    </li>
                    <li class="display-flex-col extra-curricular">
                        <h3>Extra Curricular</h3>
                        <div>
                            First XV - Rugby <br>
                            St Joseph's College- Colombo
                        </div>
                        <div>
                            Content Writer <br>
                            Colombo Beacone
                        </div>

                    </li>
                </ul> 
            </div>


            <div class="body-right display-flex-col">
                <div class="display-flex-col student-experience">
                    <h3>Experience</h3>
                    <div class="display-flex-col experience-items">
                        <p>SEO Intern</p>
                        <p>Commercial Technologies Plus</p>
                        <p>6 Months</p>
                    </div>
                    <div class="display-flex-col experience-items">
                        <p>SEO Intern</p>
                        <p>Commercial Technologies Plus</p>
                        <p>6 Months</p>
                    </div>

                </div>
                <div class="display-flex-col student-experience">
                    <h3>Qualifications</h3>
                    <div class="display-flex-col experience-items">
                        <p>The Chartered Institute of Marketing</p>
                        <p>Diploma in Porfessional Marketing</p>
                    </div>

                    <div class="display-flex-col experience-items">
                        <p>The Chartered Institute of Marketing</p>
                        <p>Diploma in Porfessional Marketing</p>
                    </div>
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
                    ruchira.bogahawatta@gmail.com
                </div>
            </div>

            <div class="bottom-right">
                <a href="" class="display-flex-row">
                    <span class="material-symbols-outlined">
                        download
                    </span>
                    Download CV
                </a>
            </div>

        </div>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>