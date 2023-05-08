<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('main_details_msg') ?>
    <?php flashMessage('company_list_msg') ?>
    <div class="company-details-main-container display-flex-row">

        <div class="company-details-container display-flex-col">
            <div class="container-top display-flex-row">
                <h2>Company Details</h2>
                <form action="<?php echo URLROOT; ?>pdc/updateUserAccountStatus/company/<?php echo $data['user_id'] ?>" method="POST">
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
                <form action="<?php echo URLROOT . 'pdc/mainCompanyDetails/' . $data['user_id']; ?>" method="POST">
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
            <form id="resend-credential-form-company" action="<?php echo URLROOT . 'register/resendCompanyCredentials/' . $data['user_id']; ?>" onSubmit="if(!confirm('Before new login credentials are sent, Please ensure that the email address is updated correctly! Do you want to proceed?')){return false;}" method="POST">
                <button type="submit" id="secondary-grey-btn">Send Login Credentials Again? Press here</button>
            </form>
            <div class="container-btns display-flex-row">
                <button id="view-btn"><a href="<?php echo URLROOT . 'profiles/company-profile/'. $data['user_id']; ?>" id="view-btn">View Profile</a></button>
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


<?php require APPROOT . '/views/includes/footer.php'; ?>