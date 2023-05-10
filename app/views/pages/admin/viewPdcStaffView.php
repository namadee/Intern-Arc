<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="viewpdcstaff-content">

<br>
        <div class="pdctop">
	
            <div class="pflex-container">
            
                <div class="pflex-wrap2">
                    <div>
                        <br>
                        <h3>PDC Users</h3>
                    </div>
                </div>
                <br>
            
                <table class="pdc-table" >
                    <tr>
                      <th class="pdc-table-header">Name</th>
                      <th class="pdc-table-header">Email</th>
                      <th class="pdc-table-header"></th>
                    </tr>
            
                    <?php foreach ($data['staff'] as $staff) : ?>
                        <tr>
                            <td class="pdc-table-data"> <?php echo $staff->username; ?></td>
                            <td class="pdc-table-data"> <?php echo $staff->email; ?></td>
                            <td class="pdc-table-data"> <button><a href="<?php echo URLROOT; ?>/admin/viewPdcUser/<?php echo $staff->user_id; ?>" >View</a></button></td>
                        </tr>
                    <?php endforeach; ?>
                 
                  </table>

                  <button><a href="<?php echo URLROOT.'admin/addPdcUser'; ?>">Add</a></button>
                       
            </div>
            </div>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>