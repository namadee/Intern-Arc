<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="viewcompany-content">

        <div class="view-co-top">
            <div class="view-co-flex-container">
                <div class="view-co-flex-wrap2">
                    <div>
                        <h3>Company Details</h3>
                    </div>
                </div>     
            </div>
            
            <div class="view-co-basic-details-row">
                <table class="vbasic-details">
                    <tr>
                        <td>Company Name</td>
                        <td class="co-data"><?php echo $data['company']->company_name; ?></td>
                    </tr>
                    
                    <tr>
                        <td>Email</td>
                        <td class="co-data"><?php echo $data['company']->company_email; ?></td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td class="co-data"><?php echo $data['company']->contact; ?></td>
                    </tr>
                </table>
            
            </div>
            
            <!-- <div class="view-co-descriptions">
                <div class="view-co-section">
                    <h3>Summarized Analysis</h3>
                    <br>
                    <div class="view-co-analysis">
                        <ul>
                            <li>Internship Advertisements listed: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp10</li>
                            <br>
                            <li>Interns Recruited:Interns Recruited: &nbsp&nbsp&nbsp&nbsp&nbsp20</li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <form class="profile-co">
            <a href="<?php echo URLROOT; ?>/admin/companyprofile/<?php echo $data['company']->company_id; ?>" class="view-st-profile-button">View Profile</a>
            <!-- <input type="submit" class="view-co-profile-button" value="View Profile">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp -->
            <input type="submit" class="view-co-blacklist-button" value="Blacklist">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <!-- <input type="submit" class="view-co-delete-button" value="Delete"> -->
            </form>
            

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>