<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

  <div class="edit-profile-top">
   
    <form id="addProfileDetails" action="<?php echo URLROOT?>Profiles/edit-student-profile-details" method="POST">
   <br><br>

    <label for="stream">Stream:</label>
      <select id="stream" name="stream">
        <option value="Information Systems">Information Systems</option>
        <option value="Computer Science">Computer Science</option>
      </select>
      <br><br>

      <label for="contact">Contact Number:</label>
      <input type="text" id="contact" name="contact" value="<?php echo $data['contact'] ?>"><br><br> 

      <label for="school">School:</label>
      <input type="text" id="school" name="school" value="<?php echo $data['school'] ?>"><br><br> 

      <label for="experience">experience:</label>
      <textarea id="experience" name="experience"><?php echo $data['experience'] ?></textarea><br><br>

      <label for="profile_description">Profile Description:</label>
      <textarea id="profile_description" name="profile_description"><?php echo $data['profile_description'] ?></textarea><br><br>

      <label for="interests">Interested Areas:</label>
      <input type="text" id="interests" name="interests" value="<?php echo $data['interests'] ?>"><br><br>

      <label for="qualifications">Qualifications:</label>
      <textarea id="qualifications" name="qualifications"><?php echo $data['qualifications'] ?></textarea><br><br>

      <label for="extracurricular">Extra Curricular Activities:</label>
      <textarea id="extracurricular" name="extracurricular"><?php echo $data['extracurricular'] ?></textarea><br><br>

      <input type="submit" value="Submit">
    </form>

</div>



<?php require APPROOT . '/views/includes/footer.php'; ?>