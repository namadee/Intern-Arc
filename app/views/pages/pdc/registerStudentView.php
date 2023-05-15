<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('upload_file_error'); ?>
    <?php flashMessage('std_register_msg'); ?>

    <div class="display-flex-row register-student-top">
        <div class="display-flex-row">Batch
            <p><?php echo $data['year']; ?></p>
        </div>
        <span class="material-symbols-outlined " id="add-student-top-icon">
            keyboard_double_arrow_right
        </span>
        <div class="display-flex-row">Degree Programme
            <p><?php echo $data['stream'] === 'IS' ? 'Information Systems' : 'Computer Systems'; ?>
            </p>
        </div>
    </div>
    <div class="add-student-container add-company-container display-flex-row">
        <div class="register-company display-flex-col">
            <h2>Register a Student</h2>
            <form action="<?php echo URLROOT . "register/register-student/" . $data['year'] . "/" . $data['stream']; ?>" method="POST" class="display-flex-col" id="student-register-form">
                <ul class="display-flex-col">
                    <li class="display-flex-col">
                        <label for="username">Student Name</label>
                        <input type="text" name="username" id="username" class="common-input" value="<?php echo $data['username']; ?>" required>
                    </li>
                    <li class="display-flex-col">
                        <div class="display-flex-col">
                            <label for="email">Student Email</label>
                            <input type="email" name="email" id="email" class="common-input" required value="<?php echo $data['email']; ?>">
                        </div>
                        <span class="input-validate-error"><?php echo $data['email_error']; ?></span>
                    </li>
                    <li class="display-flex-col">
                        <div class="display-flex-col">
                            <label for="registration_number">Registration Number</label>
                            <input type="text" name="registration_number" id="registration_number" class="common-input" value="<?php echo $data['registration_number']; ?>" required>
                        </div>

                    </li>

                    <li class="display-flex-col ">
                        <div class="display-flex-col">
                            <label for="index_number">Index Number</label>
                            <input type="text" name="index_number" id="index_number" class="common-input" required value="<?php echo $data['index_number']; ?>">
                        </div>
                        <span class="input-validate-error" id="validate-error-indexNumber"> <?php echo $data['credential_error']; ?></span>
                    </li>
                </ul>
                <button type="submit" class="common-blue-btn">Register Student</button>
                <input type="hidden" name="year" value="<?php echo $data['year']; ?>">
                <input type="hidden" name="stream" value="<?php echo $data['stream']; ?>">
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
                <p><span>Step 1 : </span>
                    Download this CSV template and enter the details accordingly.
                </p>
                <a href="<?php echo URLROOT . "templates/studentListTemplate.csv"; ?>" class="display-flex-row">
                    <span class="material-symbols-outlined">
                        downloading
                    </span>
                    Download CSV Template
                </a>
            </div>
            <div class="display-flex-col">

                <p><span>Step 2 : </span> Enter student details without changing the layout of the csv.</p>
            </div>
            <div class="display-flex-col">

                <p><span>Step 3 : </span> Upload and press register to complete the registration.</p>
            </div>
            <div class="csv-company-bottom">
                <form action="<?php echo URLROOT . "register/register-students"; ?>" name="uploadCsv" enctype="multipart/form-data" method="POST" class="display-flex-col" id="csvFormRegistration">
                    <label for="students-csv" class="display-flex-row">
                        <span class="material-symbols-outlined">
                            drive_folder_upload
                        </span>
                        <p id="form-file-name">No file Choosen</p>
                    </label>
                    <input type="file" name="students-csv" id="students-csv" accept=".csv">
                    <button type="submit" class="common-blue-btn">Register</button>
                    <input type="hidden" name="year" value="<?php echo $data['year']; ?>">
                    <input type="hidden" name="stream" value="<?php echo $data['stream']; ?>">
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    function checkMinLength() {
        var indexNumberInputValidate = document.getElementById("index_number");
        var valueInElement = input.valueInElement.toString();

        if (valueInElement.length < 8) {
            input.setCustomValidity("Index Number must be at least 8 digits long.");
        } else {
            valueInElement.setCustomValidity("");
        }
    }


</script>

<?php require APPROOT . '/views/includes/footer.php'; ?>