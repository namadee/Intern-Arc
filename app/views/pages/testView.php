<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <!-- Common Back button -->
    <a href="#" class="common-back-btn">
        <span class="material-symbols-rounded" >
            arrow_back
        </span>
    </a>
    <div class="display-flex-row register-student-top">
        <div class="display-flex-row">Batch
            <p>2022 Batch</p>
        </div>
        <span class="material-symbols-outlined " id="add-student-top-icon">
            keyboard_double_arrow_right
        </span>
        <div class="display-flex-row">Stream
            <p>Information System</p>
        </div>
    </div>
    <div class="add-student-container add-company-container display-flex-row">
        <div class="register-company display-flex-col">
            <h2>Register a Student</h2>
            <form action="<?php echo URLROOT . "register/user-add"; ?>" method="POST" class="display-flex-col">
                <ul class="display-flex-col">
                    <li class="display-flex-col">
                        <label for="username">Student Name</label>
                        <input type="text" name="username" id="username" class="common-input" required>
                    </li>
                    <li class="display-flex-col">
                        <label for="email">Student Email</label>
                        <input type="text" name="email" id="email" class="common-input" required>
                    </li>
                    <li class="display-flex-col">
                        <label for="registration_number">Registration Number</label>
                        <input type="text" name="registration_number" id="registration_number" class="common-input" required>
                    </li>

                    <li class="display-flex-row register-company-item">
                        <label for="index_number">Index Number</label>
                        <input type="text" name="index_number" id="index_number" class="common-input" required>
                    </li>
                </ul>
                <button type="submit" class="common-blue-btn">Add Student</button>
            </form>
        </div>

        <div class="csv-company display-flex-col">
            <h2>Upload CSV</h2>
            <div class="csv-company-middle display-flex-col">
                <div class="csv-instructions display-flex-row">
                    <span class="material-symbols-outlined">
                        help
                    </span>
                    Instructions
                </div>
                <p>
                    Download this CSV template and enter the details accordingly.
                </p>
                <a href="" class="display-flex-row">
                    <span class="material-symbols-outlined">
                        downloading
                    </span>
                    Download CSV Template
                </a>
            </div>
            <div class="csv-company-bottom">
                <form action="" method="POST" class="display-flex-col">
                    <label for="company-csv" class="display-flex-row">
                        <span class="material-symbols-outlined">
                            drive_folder_upload
                        </span>
                        Choose a File</label>
                    <input type="file" name="company-csv" id="company-csv">
                    <button type="submit" class="common-blue-btn">Upload CSV</button>
                </form>
            </div>
        </div>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>