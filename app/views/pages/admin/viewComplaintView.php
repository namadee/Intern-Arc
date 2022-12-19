<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="viewcomplaint-content">

<br><br><br><br>
        <div class="view-com-top">
            <div class="view-com-flex-container">
                <div class="view-com-flex-wrap2">
                    <div>
                        <h3>View Complaint</h3>
                    </div>
                </div>     
            </div>
            
            <div class="view-comp-basic-details-row">
                <table class="combasic-details">
                    <tr>
                        <td>Company Name</td>
                        <td class="comp-data">CodeGen International</td>
                    </tr>
                    <tr>
                        <td>Complaint</td>
                        <td class="comp-data">Relavant student didnt arrive to the interview.</td>
                    </tr>
                </table>
            </div>
            
            </div>
            <form class="reviewed-com">
            <input type="submit" class="view-com-reviewed-button" value="Reviewed">
            </form>


</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>