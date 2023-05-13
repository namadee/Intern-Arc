<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src="<?php echo URLROOT; ?>js/company.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>
    



<section id="add_Advertisement_page" class="main-content"> 
       <div class="add_advertisement">
       <form id="addAdvertisement" action="<?php echo URLROOT. $data['formAction']; ?>" method="POST">
          <h3>Add a New Advertisement</h3>
                <div class="addAdvertisement-items">
                <p><label for="position">Position</label></p>
                <select id="position" name="position" required>
                <?php foreach ($data['jobroleList'] as $jobrole) : ?>
                    <option value="<?php echo $jobrole->name ?>" <?php if($data['position'] == $jobrole->name){echo "selected";} ?>> <?php echo $jobrole->name ?></option>
                    <?php endforeach; ?>
                </select>
                    
            </div>
            <div class="addAdvertisement-items">
            <p><label for="job_description">Job Description</label></p>
            <textarea id="job_description" name="job_description" rows="6" cols="50" required><?php echo $data['job_description'] ?></textarea>

            </div>
           
            <div class="addAdvertisement-items">
                <p><label for="requirements">Requirements</label></p>
                <div class="display-flex-row addreqs">
                    <input type="text" id="requirements" value="">
                        <label id="addreq" for="add"><span id="addIcon" class="material-symbols-outlined">library_add</span></label>
                    <input type='button' class="add-req-btn">
                </div>
                <?php 
                    $string = $data['requirements'];
                    //$convertedString = str_replace('\n','new line',  $string);
                ?>
                <textarea cols=100 rows=10 id="requirements-list" name="requirements-list"><?php echo $data['requirements'];  ?></textarea>
                
            </div>

            <div class="addAdvertisement-items">
                <p><label for="time_period">Internship Period</label></p>
                
                <div class="time_period">
                  <input type="date" id="internship_start" name="internship_start" value="<?php echo $data['internship_start']  ?>" required><p>-</p>
                  <input type="date" max='2030-13-13' id="internship_end" name="internship_end" value="<?php echo $data['internship_end'] ?>" required>
            </div>
  
            </div>

            <div class="addAdvertisement-items">
                <p><label>No of interns</label></p>
                <input type="number" min="1" name="no_of_interns" value="<?php echo $data['no_of_interns'] ?>" max="10" required>
            </div>

            <div class="addAdvertisement-items">
                <p><label>Working Mode</label></p>
                <select id="working_mode" name="working_mode" value="<?php echo $data['working_mode'] ?>" required>
                    <option <?php if($data['working_mode'] =="remote"){echo "selected";} ?> value="remote">Remote</option>
                    <option <?php if($data['working_mode'] =="onsite"){echo "selected";} ?> value="onsite">On-site</option>
                    <option <?php if($data['working_mode'] =="hybrid"){echo "selected";} ?> value="hybrid">Hybrid</option>
                </select>
            </div>

            <div class="addAdvertisement-items">
                <p>Applicable for</p>
                <ul>
                   <li>
                    <input type="radio" id="3rdyear" name="required_year" value="3" <?php if($data['required_year'] == 3){echo "checked";} ?> required>
                    <label for="3rdyear" >3rd year</label>
                   </li>
                    <li>
                        <input type="radio" id="4thyear" name="required_year" value="4" <?php if($data['required_year'] == 4){echo "checked";} ?> required>
                        <label for="4thyear" >4th year</label>
                    </li>
                    <li>
                      <input type="radio" id="both" name="required_year" value="both" <?php if($data['required_year'] == 'both'){echo "checked";} ?> required>
                      <label for="both">Both</label>
                  </li>
                  </ul></ul>
            </div>

            <div class="addBtn">
                <button class="common-blue-btn" type="submit">Submit</button>
                </div>
           
        </form> 


       </div>  
      </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>
