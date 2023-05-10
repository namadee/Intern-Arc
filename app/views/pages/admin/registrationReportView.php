<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="registrationreport-content">

<br>
        <div class="rrtop">
	
            <div class="rrflex-container">
            
                <div class="rrflex-wrap2">
                    <div>
                        <h3>Registration Reports</h3>
                    </div>
                    <!-- <input class="registration-report-filter-button" type="submit" value="Filter"> -->
                </div>
                <br>
            
                <table class="re-table" >
                    <tr>
                      <th class="re-table-header">Company Name</th>
                      <th class="re-table-header">Company Address</th>
                      <th class="re-table-header">Email</th>
                      <th class="re-table-header">Contact Number</th>
                    </tr>

                    <?php foreach ($data['company'] as $company) : ?>
                        <tr>
                            <td class="re-table-data"> <?php echo $company->company_name; ?></td>
                            <td class="re-table-data"> <?php echo $company->company_address; ?></td>
                            <td class="re-table-data"> <?php echo $company->company_email; ?></td>
                            <td class="re-table-data"> <?php echo $company->contact; ?></td>
                        </tr>
                    <?php endforeach; ?>
            
                  </table>

                  <input class="registration-report-download-button" type="submit" value="Download PDF">
                       
            </div>
            </div>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>