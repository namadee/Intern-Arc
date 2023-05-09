<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="company-details-main-container display-flex-row">
        <div class="company-details-container display-flex-col">
            <div class="container-top display-flex-row">
                <h2>Company Details</h2>
                <div class="container-top-update">
                    <button id="blacklist-btn-company"><a href="" id="blacklist-btn" class="display-flex-row">
                            <span class="material-symbols-outlined">
                                flag
                            </span></a>
                    </button>
                    <p id="blacklist-tooltip">Blacklist Company</p>
                </div>
            </div>

            <div class="container-body">
                <!-- Update Form -->
                <form action="" method="POST">
                    <ul class=" display-flex-col">
                        <li class="display-flex-row">
                            <label for="">Company Name</label>
                            <input type="text" class="common-input" name="company-name" id="company-name">
                        </li>
                        <li class="display-flex-row">
                            <label for="">Contact Person</label>
                            <input type="text" class="common-input" name="username" id="username">
                        </li>
                        <li class="display-flex-row">
                            <label for="">Email</label>
                            <input type="text" class="common-input" name="email" id="email">
                        </li>
                        <li class="display-flex-row">
                            <label for="">Contact Number</label>
                            <input type="number" class="common-input" name="contact" id="contact">
                        </li>
                        <li class="display-flex-row" id="toggleUpdateBtn">
                            <button type="submit" class="common-blue-btn">Update</button>
                            <button type="reset" class="common-blue-btn" id="reset-btn">Reset</button>
                        </li>
                    </ul>
                </form>
            </div>
            <form id="resend-credential-form-company" action="<?php echo URLROOT . 'register/resendCompanyCredentials/' . $data['user_id']; ?>" onSubmit="if(!confirm('Before new login credentials are sent, Please ensure that the email address is updated correctly! Do you want to proceed?')){return false;}" method="POST">
                <button type="submit" class="common-blue-btn" id="reset-btn">Send Login Credentials Again</button>
            </form>
            <div class="container-btns display-flex-row">
                <button id="view-btn"><a href="<?php echo URLROOT . 'profiles/company-profile'; ?>" id="view-btn">View Profile</a></button>

                <button id="delete-btn"><a href="" id="delete-btn" class="display-flex-row">
                        <span class="material-symbols-outlined">
                            delete
                        </span>Delete</a>
                </button>
            </div>
        </div>
        <div class="company-details-analysis display-flex-col">
            <h3>Summarized Analysis</h3>
            <div class="display-flex-col analysis-items">
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