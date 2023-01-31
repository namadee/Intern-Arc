<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="add-company-container display-flex-row">
        <div class="register-company display-flex-col" id="register-company">
            <h2>Register a Company</h2>
            <form action="<?php echo URLROOT . "register/register-company"; ?>" method="POST" class="display-flex-col">
                <ul class="display-flex-col">
                    <li class="display-flex-col">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="common-input" value="<?php echo $data['company_name']; ?>" required>
                    </li>
                    <li class="display-flex-col">
                        <div class="display-flex-col">
                            <label for="email">Contact Email</label>
                            <input type="text" name="email" id="email" class="common-input" value="<?php echo $data['email']; ?>" required>
                        </div>
                        <span class="input-validate-error"><?php echo $data['email_error']; ?></span>
                    </li>
                    <li class="display-flex-col ">
                        <label for="username">Contact Person</label>
                        <input type="text" name="username" id="username" class="common-input" value="<?php echo $data['username']; ?>" required>
                    </li>

                    <li class="display-flex-col ">
                        <div class="display-flex-col register-company-item">
                            <label for="contact">Contact Number</label>
                            <input type="number" name="contact" id="contact" maxlength="10" class="common-input contact" value="<?php echo $data['contact']; ?>" required>
                        </div>
                        <span class="input-validate-error" id="input-contact-error"></span>

                    </li>
                </ul>
                <button type="submit" class="common-blue-btn" id="register-company-btn">Add Company</button>
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
                <a href="<?php echo URLROOT . "templates/companyListTemplate.csv"; ?>" class="display-flex-row">
                    <span class="material-symbols-outlined">
                        downloading
                    </span>
                    Download CSV Template
                </a>
            </div>
            <div class="display-flex-col">

                <p><span>Step 2 : </span> Enter comapny details without changing the layout of the csv.</p>
            </div>
            <div class="display-flex-col">

                <p><span>Step 3 : </span> Upload and press submit to complete the registration.</p>
            </div>
            <div class="csv-company-bottom">
                <form action="<?php echo URLROOT . "register/register-companies"; ?>" name="uploadCsv" enctype="multipart/form-data" method="POST" class="display-flex-col">
                    <label for="company-csv" class="display-flex-row">
                        <span class="material-symbols-outlined">
                            drive_folder_upload
                        </span>
                        Choose a File</label>
                    <p id="register-csv-file">No file Choosen</p>
                    <input type="file" name="company-csv" id="company-csv" accept=".csv">
                    <button type="submit" class="common-blue-btn">Register</button>
                </form>
            </div>
        </div>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>