<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="viewstudent-content">

<br>
        <div class="view-st-top">
            <div class="view-st-flex-container">
                <div class="view-st-flex-wrap2">
                    <div>
                        <h3>Student Details</h3>
                    </div>
                </div> 
                <br>    
            </div>
            
            <div class="view-st-basic-details-row">
                <table class="vst-basic-details">
                    <tr>
                        <td>Student Name</td>
                        <td class="st-data"><?php echo $data['student']->profile_name; ?></td>
                    </tr>
                    <tr>
                        <td>Registration Number</td>
                        <td class="st-data"><?php echo $data['student']->registration_number; ?></td>
                    </tr>
                    <tr>
                        <td>Index Number</td>
                        <td class="st-data"><?php echo $data['student']->index_number; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="st-data"><?php echo $data['student']->personal_email; ?></td>
                    </tr>
                </table>
            
            </div>
            <form class="profile-co">
            <!-- <input type="submit" class="view-st-profile-button" value="View Profile">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp -->
            <!-- <input type="submit" class="view-st-delete-button" value="Delete"> -->
            </form>
            <a href="<?php echo URLROOT; ?>/admin/viewstudentprofile/<?php echo $data['student']->student_id; ?>" class="view-st-profile-button">View Profile</a>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>