<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="report-content">

<div class="rtop">
	
            <div class="rflex-container">
            
                <div class="rflex-wrap2">
                    <div>
                        <h3>Company Report</h3>
                    </div>
                </div>
                <br>
            
                <table >
                    <tr>
                      <th>Reports</th>
                      <th></th>
                    </tr>
            
                    <tr>
                      <td>Registration Reports</td>
                      <td><button><a href="<?php echo URLROOT.'admin/registrationReport'; ?>">view</a></button></td>
                    </tr>
            
                    <tr>
                        <td>Advertisement  Reports</td>
                        <td><button><a href="<?php echo URLROOT.'admin/advertisementReport'; ?>">view</button></td>
                    </tr>
            
                  </table>
                       
            </div>
            </div>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>