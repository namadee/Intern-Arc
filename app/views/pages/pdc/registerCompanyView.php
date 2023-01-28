<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="add-company-container display-flex-row">
        <div class="register-company display-flex-col">
            <h2>Register a Company</h2>
            <form action="<?php echo URLROOT . "register/register-company"; ?>" method="POST" class="display-flex-col">
                <ul class="display-flex-col">
                    <li class="display-flex-col">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="common-input" required>
                    </li>
                    <li class="display-flex-col">
                        <label for="email">Contact Email</label>
                        <input type="text" name="email" id="email" class="common-input" required>
                    </li>
                    <li class="display-flex-row register-company-item">
                        <label for="username">Contact Person</label>
                        <input type="text" name="username" id="username" class="common-input" required>
                    </li>

                    <li class="display-flex-row register-company-item">
                        <label for="contact">Contact Number</label>
                        <input type="text" name="contact" id="contact" class="common-input" required>
                    </li>
                </ul>
                <button type="submit" class="common-blue-btn">Add Company</button>
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