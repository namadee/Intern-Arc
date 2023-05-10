<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="viewstudentlist-content">

<br>
        <div class="vstop">
	
            <div class="vsflex-container">
            
                <div class="vsflex-wrap2">
                    <div>
                        <h3>Student List </h3>
                    </div>
                    <div>
                        <form id="coform">
                            <input type="text" placeholder="Search Register Number" name="search">
                        </form><br>
                    </div>
                </div>
            
                <table class="st-table" >
                    <tr>
                      <th class="st-table-header">Student Name</th>
                      <th class="st-table-header">Register Number</th>
                      <th class="st-table-header">Email</th>
                      <th class="st-table-header">Contact Number</th>
                      <th class="st-table-header"></th>
                    </tr>
            
                    <?php foreach ($data['student'] as $student) : ?>
                        <tr>
                            <td class="st-table-data"> <?php echo $student->profile_name; ?></td>
                            <td class="st-table-data"> <?php echo $student->registration_number; ?></td>
                            <td class="st-table-data"> <?php echo $student->personal_email; ?></td>
                            <td class="st-table-data"> <?php echo $student->contact; ?></td>
                            <td class="st-table-data"> <button><a href="<?php echo URLROOT; ?>/admin/viewStudent/<?php echo $student->student_id; ?>" >View</a></button></td>
                        </tr>
                    <?php endforeach; ?>
                   
            
                    
                  </table>
                       
            </div>
            </div>


</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>