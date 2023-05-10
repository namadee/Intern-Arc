<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('main_details_msg') ?>
    <?php flashMessage('company_list_msg') ?>


    <div class="company-details-main-container display-flex-row">

        <div class="company-details-container display-flex-col">
            <div class="container-top display-flex-row">
                <h2>Company Details</h2>
                <form action="<?php echo URLROOT; ?>admin/updateUserAccountStatus/company/<?php echo $data['user_id'] ?>" method="POST">
                    <div id="std-system-access">
                        <label for="account_status">Account Status</label>

                        <select name="account_status" id="account_status" onchange="this.form.submit()" class="<?php echo ($data['account_status'] == 'active') ? "" : " danger"; ?>">
                            <option value="active" <?php if ($data['account_status'] == "active") {
                                                        echo "selected";
                                                    } ?>>Active</option>
                            <option value="deactivated" <?php if ($data['account_status'] == "deactivated") {
                                                            echo "selected";
                                                        } ?>>Deactivated</option>
                        </select>
                    </div>
                </form>
            </div>
            
            <div class="container-body">
                <!-- Update Form -->
                <form action="<?php echo URLROOT . 'admin/mainCompanyDetails/' . $data['user_id']; ?>" method="POST">
                    <ul class=" display-flex-col">
                        <li class="display-flex-row">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="common-input" name="company_name" id="company_name" value="<?php echo $data['company_name']; ?>" required>
                        </li>
                        <li class="display-flex-row">
                            <label for="">Contact Person</label>
                            <input type="text" class="common-input" name="username" id="username" value="<?php echo $data['username']; ?>" required>
                        </li>
                        <li class="display-flex-row">
                            <label for="">Email</label>
                            <input type="text" class="common-input" name="email" id="email" value="<?php echo $data['email']; ?>" required>
                            <input type="hidden" class="common-input" name="old_email" id="old_email" value="<?php echo $data['email']; ?>" required>
                        </li>
                        <li class="display-flex-row">
                            <label for="">Contact Number</label>
                            <input type="number" class="common-input" name="contact" id="contact" value="<?php echo $data['contact']; ?>" required>
                        </li>
                        <li class="display-flex-row" id="toggleUpdateBtn">
                            <button type="submit" class="common-blue-btn">Update</button>
                            <button type="reset" class="common-blue-btn" id="reset-btn">Reset</button>
                        </li>
                    </ul>
                </form>
            </div>
            <button <?php echo $data['element_status']; ?> id="secondary-grey-btn" class="blacklist-btn-company" onclick="window.location.href = '<?php echo URLROOT . 'admin/mainCompanyDetails/' . $data['user_id'] . '/delete' ?>';"><?php echo $data['element_msg']; ?></button>
            <div class="container-btns display-flex-row">
                <button id="view-btn"><a href="<?php echo URLROOT . 'profiles/company-profile/' . $data['user_id']; ?>" id="view-btn">View Profile</a></button>
            </div>
        </div>
        <div class="company-details-analysis display-flex-col">
            <h2>Summarized Analysis</h2>
            <div class="display-flex-col analysis-items">
                <form action="">
                    <label for="year">Select a Year</label>
                    <select name="year" id="" class="common-input">
                        <option value="2023">2023</option>
                        <option value="2023">2023</option>
                        <option value="2023">2023</option>
                        <option value="2023">2023</option>
                    </select>
                </form>
                <div class="display-flex-row">
                    <p>Total Advertisements Listed</p>
                    <span>10</span>
                </div>
                <div class="display-flex-row">
                    <p>Total Students Recruited</p>
                    <span>10</span>
                </div>
                <div class="display-flex-row">
                    <p>Total Students Recruited</p>
                    <span>10</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- VIEW  BLACKLIST UPDATE MODAL -->
<div class="common-modal-box <?php echo $data['modal_class']; ?>">
    <div class="std-batches-add display-flex-col" id="change-access-modal">
        <a href="<?php echo URLROOT . 'admin/main-company-details/' . $data['user_id']; ?>" id="modal-box-close">
            <span class="material-symbols-outlined" class="common-modal-close">
                close
            </span></a>

        <form action="<?php echo URLROOT . 'admin/deactivatedCompanies/'. $data['user_id']; ?>" id="add-student-batch" class="display-flex-col common-modal-box-form" method="POST">
            <h3>Delete Company</h3>
            <div class="display-flex-col">
                <label>Are you sure you want to delete this company? This action cannot be undone. </label>
                <button type="submit" id="delete-company_button">Delete Company</button>
                <input type="hidden" name="userID" value="<?php echo $data['user_id'] ?>">
            </div>
        </form>
    </div>


</div>
<?php require APPROOT . '/views/includes/footer.php'; ?>