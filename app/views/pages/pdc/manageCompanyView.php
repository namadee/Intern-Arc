<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="manage-company-top display-flex-row">
        <div class="manage-company-top-left display-flex-row">
            <div class="manage-company-access display-flex-row">
                System Access :
                <div class="common-status display-flex-row">
                    <span class="common-status-span">
                    </span>
                    Active
                </div>
            </div>
            <button class="common-blue-btn">
                Update
            </button>
        </div>
        <div class="manage-company-top-right display-flex-row">
            <a href="<?php echo URLROOT.'register/register-company';?>" class="common-blue-btn display-flex-row">
                <span class="material-symbols-outlined">
                    add_to_photos
                </span>
                Register Company</a>
            <a href="" class="common-blue-btn display-flex-row" id="blacklist-company-btn">
                <span class="material-symbols-outlined">
                    flag
                </span>
                Blacklisted</a>
        </div>
    </div>
    <div class="company-content-container display-flex-col">
        <div class="company-content-top display-flex-row">
            <h2>Company List</h2>
            <!-- Common Search Bar Style-->
            <form action="" class="common-search-bar display-flex-row">
                <span class="material-symbols-rounded">
                    search
                </span>
                <input class="common-input" type="text" name="search-item" placeholder="Search Company">
            </form>

        </div>
        <div class="manage-company-table">
            <table>
                <thead>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th id="action-th"></th>

                </thead>
                <tbody>
                    <tr>
                        <td>Virtusa</td>
                        <td>Ruchira</td>
                        <td>ruchira@gmail.com</td>
                        <td>0712015478</td>
                        <td><a href="<?php echo URLROOT.'companies/company-details';?>">View</a></td>
                    </tr>

                    <tr>
                        <td>Virtusa</td>
                        <td>Ruchira</td>
                        <td>ruchira@gmail.com</td>
                        <td>0712015478</td>
                        <td><a href="<?php echo URLROOT.'companies/company-details';?>">View</a></td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>