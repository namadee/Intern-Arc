<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="company-details-main-container display-flex-row">
        <?php flashMessage('main_details_msg') ?>
        <div class="company-details-container display-flex-col" id="student-details-view">
            <div class="container-top display-flex-row">
                <h2>Complaint Details</h2>
                <p>Reference Number : <span id="complaint_reference"><?php echo  $data['reference_number']; ?></span></p>
            </div>

            <div class="container-body">
                <!-- Update Form -->
                <form action="#">
                    <ul class="display-flex-col">
                        <li class="display-flex-row">
                            <label for="username">Username</label>
                            <input type="text" class="common-input"  value="<?php echo  $data['username']; ?>" readonly>
                        </li>
                        <li class="display-flex-row">
                            <label for="name"><?php echo  $data['additionalInputLabel']; ?></label>
                            <input type="text" class="common-input" value="<?php echo  $data['additionalInputValue']; ?>" readonly>
                        </li>
                        <li class="display-flex-row">
                            <label for="subject">Subject</label>
                            <input type="text" class="common-input" value="<?php echo  $data['subject']; ?>" readonly>
                        </li>
                        <li class="display-flex-row">
                            <label for="description">Description</label>
                            <textarea rows = "5" readonly id="complaint_description_textarea" cols="30" rows="10"><?php echo  $data['description']; ?></textarea>
                        </li>
                        <li class="display-flex-row">
                            <label for="date">Submitted Date</label>
                            <input type="text" class="common-input" value="<?php echo  $data['date']; ?>" readonly>
                        </li>
                        <li class="display-flex-row" id="student-batch-stream">
                            <label for="index_number">Email</label>
                            <input type="text" class="common-input" value="<?php echo  $data['email']; ?>" readonly >
                        </li>

                    </ul>
                </form>
            </div>

            <div class="container-btns display-flex-row">
                <form action="<?php echo URLROOT; ?>admin/updateComplaintStatus/<?php echo $data['complaintID'] ?>" id="complaintStatusForm" method="POST">
                    <div id="std-system-access">
                        <label for="account_status">Update Complaint Status</label>
                        <select name="status" id="status" onchange="this.form.submit()" class="<?php echo ($data['status'] == '1') ? "" : " danger"; ?>">
                            <option value="0" <?php if ($data['status'] == "0") {
                                                    echo "selected";
                                                } ?>>Pending</option>
                            <option value="1" <?php if ($data['status'] == "1") {
                                                    echo "selected";
                                                } ?>>Reviewed</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>