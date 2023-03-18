<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src="<?php echo URLROOT; ?>js/addAdvertisement.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>




<section id="add_Advertisement_page" class="main-content"> 
       <div class="add_advertisement">
       <form id="addAdvertisement" action="<?php echo URLROOT. $data['formAction']; ?>" method="POST">
          <h3>Edit Profile</h3>
                <div class="addAdvertisement-items">
                <label for="profile_name">Profile Name:</label>
                <input type="text" id="profile_name" name="profile_name">

                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact">

                <label for="personal_email">Personal Email:</label>
                <input type="text" id="personal_email" name="personal_email">
                
                <label for="profile_description">Profile Description:</label>
                <textarea id="profile_description" name="profile_description" rows="6" cols="50" required></textarea>
                    
            
           
            <div class="addAdvertisement-items">
                <p><label for="requirements">Interested Areas</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="requirements" name="requirements" value="">
                        <label id="addreq" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="requirements-list" name="requirements-list"></textarea>
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="requirements">Experience</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="requirements" name="requirements" value="">
                        <label id="addreq" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="requirements-list" name="requirements-list"></textarea>
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="requirements">Qualifications</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="requirements" name="requirements" value="">
                        <label id="addreq" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="requirements-list" name="requirements-list"></textarea>
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="requirements">Extra Curricular Activities</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" class="add-req-btn" id="requirements" name="requirements" value="">
                        <label id="addreq" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button'>
                </div>
               
                <textarea cols=10 rows=10 id="requirements-list" name="requirements-list"></textarea>
                
            </div>
  
            </div>

            <div class="addBtn">
                <button class="common-blue-btn" type="submit">Update</button>
            </div>
           
        </form> 


       </div>  
      </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>
