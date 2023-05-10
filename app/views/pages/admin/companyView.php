<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="company-content">

<br><br><br>
        <div class="vtop">
	
            <div class="vflex-container">
            
                <div class="vflex-wrap2">
                    <div>
                        <h3>Company List</h3>
                    </div>
                    <div>
                        <form id="coform">
                            <input type="text" placeholder="Search Company" name="search">
                            <!-- <?php foreach ($results as $result): ?>
                                <div>
                                <h2><?php echo $result['title']; ?></h2>
                                <p><?php echo $result['description']; ?></p>
                                </div>
                            <?php endforeach; ?>             -->
                        </form><br>
                    </div>
                </div>

            
                <table class="co-table" >
                    <tr>
                      <th class="co-table-header">Company Name</th>
                      <th class="co-table-header">Email</th>
                      <th class="co-table-header">Contact Number</th>
                      <th class="co-table-header"></th>
                      
                      <?php foreach ($data['company'] as $company) : ?>
                        <tr>
                            <td class="co-table-data"> <?php echo $company->company_name; ?></td>
                            <td class="co-table-data"> <?php echo $company->company_email; ?></td>
                            <td class="co-table-data"> <?php echo $company->contact; ?></td>
                            <td class="co-table-data"> <button><a href="<?php echo URLROOT; ?>/admin/viewCompany/<?php echo $company->company_id; ?>" >View</a></button></td>
                        </tr>
                    <?php endforeach; ?>
                    </tr>
            
                    
                    
                  </table>

                  <!-- <input class="company-list-blacklisted-button" type="submit" value="Blacklisted"> -->
                       
            </div>
            </div>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>