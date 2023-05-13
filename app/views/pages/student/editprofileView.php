<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<!-- <script src="<?php echo URLROOT; ?>js/editProfile.js" defer></script> -->
<script src="<?php echo URLROOT; ?>js/editStudentProfile.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>


<section id="add_Advertisement_page" class="main-content">
     <?php flashMessage('profile_update_status'); ?>
       <div class="add_advertisement">
       <form id="addProfileDetails" action="<?php echo URLROOT?>Profiles/edit-student-profile-details" method="POST" enctype="multipart/form-data">
          <h3>Edit Profile</h3>
                <div class="addAdvertisement-items">
                <label for="profile_name">Profile Name:</label>
                <input type="text" id="profile_name" name="profile_name" value="<?php echo $data['profile_name'] ?>" required>

                Profile Image:  <!--class="common-blue-btn" id="profile_image" -->

                <label for="profile_image"  id="company-edit-btn">
                        <input type="file" onchange="displayImageName(this.files[0].name)"  name="profile_image" accept=".png , .jpg ,.jpeg"> 
                </label>

                <label for="stream">Stream:</label>
                    <select id="stream" name="stream">
                    <option value="Information Systems">Information Systems</option>
                    <option value="Computer Science">Computer Science</option>
                </select>

                <label for="contact">Contact Number: <small>(Use format 07XXXXXXXX)</small></label>
                <input type="tel" id="contact" name="contact" value="<?php echo $data['contact'] ?>" pattern="[0-9]{10}" required>
                

                <label for="personal_email">Personal Email:</label>
                <input type="text" id="personal_email" name="personal_email" value="<?php echo $data['personal_email'] ?>" required>

                <label for="github_link">Github Profile Link:</label>
                <input type="text" id="github_link" name="github_link" value="<?php echo $data['github_link'] ?>" required>

                <label for="linkedin_link">Linkedin Profile Link:</label>
                <input type="text" id="linkedin_link" name="linkedin_link" value="<?php echo $data['linkedin_link'] ?>" required>

                <label for="school">School:</label>
                <input type="text" id="school" name="school" value="<?php echo $data['school'] ?>" required>
                
                <label for="profile_description">Profile Description:</label>
                <textarea id="profile_description" name="profile_description" rows="6" cols="70" required><?php echo $data['profile_description'] ?></textarea>
                    
            
           
            <div class="addAdvertisement-items">
                <p><label for="interests">Interested Areas</label></p>
                
                <div class="display-flex-row addreqs">
                
                    <div id="add-interest-area"> <?php 

                    $text = explode(", ",$data['interests']);
                    $length = count($text);
                    for($i=0; $i<$length;$i++){?>
                        <input type='text' class="interest-area" name="interests[]" value="<?php echo $text[$i] ?>">
                    
                    <?php 
                    }
                    ?>   
                        
                    </div>
                    <label id="interested" for="add"><span id="add-interest-icon" class="material-symbols-outlined">library_add</span></label>
                    <label><div onclick="deleteint()" id="delete-interest-icon" class="material-symbols-outlined"  >delete</div></label>
                    
                    
                       
                </div>
               
                
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="experience">Experience</label></p>
                <div class="display-flex-row addreqs">
                <div id="add-exp-area">
                <?php 

                $text = explode(", ",$data['experience']);
                $length = count($text);
                for($i=0; $i<$length;$i++){?>
                <textarea cols=10 rows=10 id="experience-list" name="experiences[]"><?php echo $text[$i] ?></textarea> 
                <?php 
                    }
                    ?> 
                   
        
                </div>
                <label id="exp" for="add"><span id="addExpIcon" class="material-symbols-outlined">library_add</span></label>
                <label><div onclick="deleteexp()" id="delete-interest-icon" class="material-symbols-outlined"  >delete</div></label>
                </div>
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="qualifications">Qualifications</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="qualifications" name="qualifications" value="">
                        <label id="qual" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="qualifications-list" name="qualifications-list" required><?php echo $data['qualifications'] ?></textarea>
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="extracurricular">Extra Curricular Activities</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="extracurricular" name="extracurricular" value="">
                        <label id="extra" for="add"><span id="addIcon" class="material-symbols-outlined" required>library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="extracurricular-list" name="extracurricular-list"><?php echo $data['extracurricular'] ?></textarea>
                
            </div>
  
            </div>

            <div class="addBtn">
                <button class="common-blue-btn" type="submit">Update</button>
            </div>
           
        </form> 


       </div>  
      </section>

<script>
      function deleteint(){
    // alert("Hello");
    const interestAreas = document.getElementById("add-interest-area");
    interestAreas.removeChild(interestAreas.lastElementChild);

    
}

function deleteexp(){
    // alert("Hello");
    const expAreas = document.getElementById("add-exp-area");
    expAreas.removeChild(expAreas.lastElementChild);
    
}
</script>


<?php require APPROOT . '/views/includes/footer.php'; ?>