<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="advertisementreport-content">

<br>
        <div class="rrtop">
	
            <div class="rrflex-container">
            
                <div class="rrflex-wrap2">
                    <div>
                        <h3>Advertisement Reports</h3>
                    </div>
                    <!-- <input class="registration-report-filter-button" type="submit" value="Filter"> -->
                </div>
                <br>
            
                <table class="re-table" >
                    <tr>
                      <th class="re-table-header">Company Name</th>
                      <th class="re-table-header">Job Position</th>
                      <th class="re-table-header">Interns</th>
                    </tr>

                    <?php foreach ($data['advertisement'] as $advertisement) : ?>
                        <tr>
                            <td class="re-table-data"> <?php echo $advertisement->company_name; ?></td>
                            <td class="re-table-data"> <?php echo $advertisement->position; ?></td>
                            <td class="re-table-data"> <?php echo $advertisement->intern_count; ?></td>

                        </tr>
                    <?php endforeach; ?>
            
                    
                  </table>
                  <br>
                            <!-- <ul>
                                <li>Total Advertisements &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp:20</li>
                                <li>Total Interns Recruited   &nbsp&nbsp&nbsp : 20</li>
                            </ul> -->

                  <input class="registration-report-download-button" type="submit" value="Download PDF">
                       
            </div>
            </div>


</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>