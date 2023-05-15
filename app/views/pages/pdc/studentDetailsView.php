<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="company-details-main-container display-flex-row">
        <?php flashMessage('main_details_msg') ?>
        <div class="company-details-container display-flex-col" id="student-details-view">
            <div class="container-top display-flex-row">
                <h2>Student Details</h2>
                <form action="<?php echo URLROOT; ?>pdc/updateUserAccountStatus/student/<?php echo $data['user_id'] ?>" method="POST">
                    <div id="std-system-access">
                        <label for="account_status">Current Account Status</label>
                        <?php
                        if ($roundDataArray['roundNumber'] != NULL) {
                            // Need Round Constraints
                            $elementStatus = "disabled";
                        } else {
                            // No need of round constraints
                            $elementStatus = "";
                        }
                        ?>
                        <select <?php echo $elementStatus; ?> name="account_status" id="account_status" onchange="this.form.submit()" class="<?php echo ($data['account_status'] == 'active') ? "" : " danger"; ?>">
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
                <form action="<?php echo URLROOT ?>pdc/main-student-details/<?php echo $data['user_id']; ?>" method="POST">
                    <ul class="display-flex-col">
                        <li class="display-flex-row">
                            <label for="username">Student Name</label>
                            <input type="text" class="common-input" name="username" id="username" value="<?php echo $data['username']; ?>" required>
                        </li>
                        <li class="display-flex-row">
                            <label for="registration_number">Registration Number</label>
                            <input type="text" class="common-input" name="registration_number" id="registration_number" value="<?php echo $data['registration_number']; ?>" required>
                        </li>
                        <li class="display-flex-row">
                            <label for="email">Email</label>
                            <input type="email" class="common-input" name="email" id="email" value="<?php echo $data['email']; ?>" required>
                            <input type="hidden" name="old_email" value="<?php echo $data['email']; ?>" required>

                        </li>
                        <li class="display-flex-row">
                            <label for="index_number">Index Number</label>
                            <input type="number" class="common-input" name="index_number" id="index_number" value="<?php echo $data['index_number'];  ?>" required>
                        </li>
                        <li class="display-flex-row" id="student-batch-stream">
                            <div class="display-flex-row">
                                <label for="batch_year">Batch</label>
                                <select <?php echo $elementStatus; ?> name="batch_year" id="batch_year" required class="common-input">
                                    <?php foreach ($data['batch_list'] as $batch) : ?>
                                        <?php $std_batch = $data['std_batch'];    ?>
                                        <option value="<?php echo $batch->batch_year; ?>" <?php if ($batch->batch_year == $std_batch) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $batch->batch_year; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="display-flex-row">
                                <label for="stream">Degree Programme</label>
                                <select name="stream" id="stream" required class="common-input">
                                    <option <?php if ($data['stream'] == "IS") {
                                                echo "selected";
                                            } ?> value="IS">Information Systems</option>
                                    <option <?php if ($data['stream'] == "CS") {
                                                echo "selected";
                                            } ?> value="CS">Computer Systems</option>
                                </select>
                            </div>

                        </li>
                        <li class="display-flex-row" id="toggleUpdateBtn">
                            <button type="submit" class="common-blue-btn" id="update_btn">Update</button>
                            <button type="reset" class="common-blue-btn" id="reset-btn">Reset</button>
                        </li>

                    </ul>
                </form>
            </div>

            <div class="container-btns display-flex-row">
                <button id="view-btn" class="common-blue-btn"><a href="<?php echo URLROOT . 'profiles/view-student-profile/'.$data['user_id']?>" id="view-btn">View Profile</a></button>

                <form id="resend-login-credential-form" action="<?php echo URLROOT . 'register/resendStudentCredentials/' . $std_batch . '/' . $data['stream'] . '/' . $data['user_id']; ?>" onSubmit="if(!confirm('Before new login credentials are sent, Please ensure that the email address is updated correctly! Do you want to proceed?')){return false;}" method="POST">
                    <button type="submit" id="secondary-grey-btn" >Send Login Credentials Again? Press here</button>
                </form>
            </div>
        </div>
    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>