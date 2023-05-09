<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="create-sche_page" class="main-content create-sche-main-content"> 
    <div class="create-sche-main-container">
        <div class="create-sche-top display-flex-row">
            <h1>Create Interview Schedule</h1>
            <h1>Software Engineer - Virtusa</h1>
        </div>
        <div class="duration-divs">
            <div>
                <label for="sche-period">Date Period</label>&nbsp;
                <input type="date" name="sche-start">- 
                <input type="date" name="sche-end">
            </div>
            <div>
                <label for="duration">Interview Duration</label>&nbsp;
                <select name="durations" id="durations">
                    <option value="15">15 minutes</option>
                    <option value="30">30 minutes</option>
                    <option value="1">1 Hour</option>
                </select>
            </div>
        </div>
        <div class="display-flex-row sche-inputs">
            <label for="interviewee_count">
                No of Interviewee <input type="number" id="Interviewee_count">  
            </label>
            <div class="display-flex-col">
                <label for="start-time-input">
                    Time periods Interviews are held
                </label>
                <div class="display-flex-row">
                    <input type="time" id="start-time-input" name="start-time-input" min="09:00" max="18:00" required>
                    <input type="time" id="end-time-input" name="end-time-input" min="09:00" max="18:00" required>
                    <div class="add-slot" id="time-slot-btn">
                        <a href=""><span id="addIcon" class="material-symbols-outlined">library_add</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="create-sche-bottom">  
        <div class="select-day">
                <P>Select The Day</P><br>
                <table class="dowtable">
                    <tr>
                        <td>
    	                    <div class="dowPickerOption">
        	                    <input type="checkbox" id="dow1">
      		                    <label for="dow1">Monday</label>
                            </div>
                        </td>
                        <td>
                            <div class="dowPickerOption" > 
    	                        <input type="checkbox" id="dow2">
  		                        <label for="dow2"> Tuesday</label>
                            </div>
                        </td>
                        <td>
                            <div class="dowPickerOption">
                                <input type="checkbox" id="dow3">
  		                        <label for="dow3">Wednesday</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="dowPickerOption">
                                <input type="checkbox" id="dow4">
  		                        <label for="dow4">Thursday</label>
                            </div>
                        </td>
                        <td>
                            <div class="dowPickerOption">
                                <input type="checkbox" id="dow5">
  		                        <label for="dow5">Friday</label>
                            </div>
                        </td>
                        <td>
                            <div class="dowPickerOption">
                                <input type="checkbox" id="dow6">
  		                        <label for="dow6">Saturday</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="dowPickerOption">
                                <input type="checkbox" id="dow7">
  		                        <label for="dow7">Sunday</label>
                            </div>
                        </td>
                        <!-- <td></td>
                        <td></td> -->
                    </tr>
                </table>
            </div>
            <div class="select-time">
                <table class="time-slot-table">
                    <tr>
                        <td class="slot"><div><p>01:00 PM</p></div></td>
                        <td class="slot"><div><p>12:00 AM</p></div></td>
                        <td>
                            <a href=""  id="delete"><span class="material-symbols-outlined">delete</span></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="slot"><div><p>01:00 PM</p></div></td>
                        <td class="slot"><div><p>12:00 AM</p></div></td>
                        <td>
                            <a href=""  id="delete"><span class="material-symbols-outlined">delete</span></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="slot"><div><p>01:00 PM</p></div></td>
                        <td class="slot"><div><p>12:00 AM</p></div></td>
                        <td>
                            <a href=""  id="delete"><span class="material-symbols-outlined">delete</span></a>
                        </td>
                    </tr>
                   
                </table>
            
            </div>

        </div> 
    <div class="addBtn saveBtn">
            <a href="<?php echo URLROOT; ?>companies/InterviewSchedule" class="common-blue-btn"><span class="material-symbols-outlined">bookmarks</span>Save</a>
    </div>
    </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>
