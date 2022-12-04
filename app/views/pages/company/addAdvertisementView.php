<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/navbar.php'; ?>




<section id="add_Advertisement_page" class="main-content"> 
       <div class="add_advertisement">

        <form id="addAdvertisement" action="<?php echo URLROOT."Advertisements/add-advertisement"; ?>" method="POST">
          <h3>Add a new Advertisement</h3>
                <div class="addAdvertisement-items">
                <p><label for="position">Position</label></p>
                <select id="position" name="position">
                    <option>Software Engineer</option>
                    <option>Business Analyst</option>
                    <option>QA engineer</option>
                </select>

            </div>
            <div class="addAdvertisement-items">
            <p><label for="job_description">Job Description</label></p>
            <textarea id="job_description" name="job_description" value="<?php echo $data['job_description'] ?>" rows="6" cols="50"></textarea>

            </div>
           
            <div class="addAdvertisement-items">
            <p><label for="other_requirements">Other Requirements</label></p>
            <textarea id="other_requirements" name="other_requirements" value="<?php echo $data['other_requirements'] ?>" rows="6" cols="50"></textarea>

            </div>

            <div class="addAdvertisement-items">
                <p><label for="time_period">Internship Period</label></p>
                <div class="time_period">
                  <input type="date" id="internship_start" name="internship_start" value="<?php echo $data['internship_start'] ?>"><p>-</p>
                  <input type="date" max='2030-13-13' id="internship_end" name="internship_end" value="<?php echo $data['internship_end'] ?>">
            </div>
  
            </div>

            <div class="addAdvertisement-items">
                <p><label>No of interns</label></p>
                <input type="number" min="0" name="no_of_interns" value="<?php echo $data['no_of_interns'] ?>">
            </div>

            <div class="addAdvertisement-items">
                <p><label>Working Mode</label></p>
                <select id="working_mode" name="working_mode" value="<?php echo $data['working_mode'] ?>">
                    <option>Remote</option>
                    <option>On-site</option>
                    <option>Hybrid</option>
                </select>
            </div>

            <div class="addAdvertisement-items">
                <p>Applicable for</p>
                <ul>
                   <li>
                    <input type="radio" id="3rdyear" name="required_year" value="<?php echo $data['required_year'] ?>">
                    <label for="3rdyear" >3rd year</label>
                   </li>
                    <li>
                        <input type="radio" id="4thyear" name="required_year" value="<?php echo $data['required_year'] ?>">
                        <label for="4thyear" >4th year</label>

                    </li>
                    <li>
                      <input type="radio" id="both" name="required_year" value="<?php echo $data['required_year'] ?>">
                      <label for="both">Both</label>
                  </li>
                  </ul></ul>
            </div>

            <div class="addBtn">
<!--               
                  <a  href="<php echo URLROOT; ?>/Advertisements/" ><span id="addIcon" class="material-symbols-outlined">
                    save
                    </span>Save</a> -->
                <button class="common-blue-btn" type="submit">save</button>
                  </div>
           
        </form> 
       
       </div>  
      </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>
