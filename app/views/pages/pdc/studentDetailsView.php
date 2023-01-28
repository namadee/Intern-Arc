<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="company-details-main-container display-flex-row">
        <div class="company-details-container display-flex-col" id="student-details-view">
            <div class="container-top display-flex-row">
                <h2>Student Details</h2>
                <div class="container-top-update">
                    <div class="common-edit-btn" onclick="toggleProfileUpdate()"><span class="material-symbols-outlined">
                            edit_square
                        </span></div>
                </div>
            </div>

            <div class="container-body">
                <!-- Update Form -->
                <form action="" method="POST">
                    <ul class=" display-flex-col">
                        <li class="display-flex-row">
                            <label for="">Student Name</label>
                            <input type="text" class="common-input" name="company-name" id="company-name">
                        </li>
                        <li class="display-flex-row">
                            <label for="">Registration Number</label>
                            <input type="text" class="common-input" name="username" id="username">
                        </li>
                        <li class="display-flex-row">
                            <label for="">Email</label>
                            <input type="text" class="common-input" name="email" id="email">
                        </li>
                        <li class="display-flex-row">
                            <label for="">Index Number</label>
                            <input type="number" class="common-input" name="contact" id="contact">
                        </li>
                        <li class="display-flex-row" id="toggleUpdateBtn">
                            <button type="submit" class="common-blue-btn">Update</button>
                        </li>
                        
                    </ul>
                </form>
            </div>

            <div class="container-btns display-flex-row">
                <button id="view-btn"><a href="<?php echo URLROOT.'profiles/student-profile';?>" id="view-btn">View Profile</a></button>
                <button id="delete-btn"><a href="" id="delete-btn" class="display-flex-row">
                        <span class="material-symbols-outlined">
                            delete
                        </span>Delete</a>
                </button>
            </div>
        </div>
    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>