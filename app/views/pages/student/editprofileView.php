<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src="<?php echo URLROOT; ?>js/editProfile.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>


<section id="add_Advertisement_page" class="main-content"> 
       <div class="add_advertisement">
       <form id="addProfileDetails" action="<?php echo URLROOT?>Profiles/edit-student-profile-details" method="POST">
          <h3>Edit Profile</h3>
                <div class="addAdvertisement-items">
                <label for="profile_name">Profile Name:</label>
                <input type="text" id="profile_name" name="profile_name" value="<?php echo $data['profile_name'] ?>">

                <label for="stream">Stream:</label>
                    <select id="stream" name="stream">
                    <option value="Information Systems">Information Systems</option>
                    <option value="Computer Science">Computer Science</option>
                </select>

                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact" value="<?php echo $data['contact'] ?>">

                <label for="personal_email">Personal Email:</label>
                <input type="text" id="personal_email" name="personal_email" value="<?php echo $data['personal_email'] ?>">

                <label for="school">School:</label>
                <input type="text" id="school" name="school" value="<?php echo $data['school'] ?>">
                
                <label for="profile_description">Profile Description:</label>
                <textarea id="profile_description" name="profile_description" rows="6" cols="70" required><?php echo $data['profile_description'] ?></textarea>
                    
            
           
            <div class="addAdvertisement-items">
                <p><label for="interests">Interested Areas</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="interests" name="interests" value="">
                        <label id="interested" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="interests-list" name="interests-list"><?php echo $data['interests'] ?></textarea>
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="experience">Experience</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="experience" name="experience" value="<?php echo $data['experience'] ?>">
                        <label id="exp" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="experience-list" name="experience-list"></textarea>
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="qualifications">Qualifications</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="qualifications" name="qualifications" value="<?php echo $data['qualifications'] ?>">
                        <label id="qual" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="qualifications-list" name="qualifications-list"></textarea>
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="extracurricular">Extra Curricular Activities</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="extracurricular" name="extracurricular" value="<?php echo $data['extracurricular'] ?>">
                        <label id="extra" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="extracurricular-list" name="extracurricular-list"></textarea>
                
            </div>
  
            </div>

            <div class="addBtn">
                <button class="common-blue-btn" type="submit">Update</button>
            </div>
           
        </form> 


       </div>  
      </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>