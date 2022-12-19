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
                        <td class="st-data">Ruchira Bogahawatta</td>
                    </tr>
                    <tr>
                        <td>Registration Number</td>
                        <td class="st-data">2020/IS/109</td>
                    </tr>
                    <tr>
                        <td>Index Number</td>
                        <td class="st-data">20021097</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="st-data">ruchira@ucsc.ac.cmb.lk</td>
                    </tr>
                </table>
            
            </div>
            <form class="profile-co">
            <input type="submit" class="view-st-profile-button" value="View Profile">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <input type="submit" class="view-st-delete-button" value="Delete">
            </form>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>