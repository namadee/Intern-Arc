<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('company_list_msg') ?>
    <?php flashMessage('status_msg') ?>
    <div class="manage-company-top display-flex-row">
        <div class="manage-company-top-left display-flex-row">
            <div class="manage-company-access display-flex-row">
                <div class="display-flex-row">
                    System Access
                    <span class="material-symbols-outlined tooltip">
                        help
                        <p class="tooltiptext">Determine whether all the companies can logged <br> in to the system or not</p>
                    </span>
                </div>
                <div class="common-status display-flex-row <?php echo ($data['company_access'] == 1) ? "" : "red-status-font";  ?>">
                    <span class="common-status-span <?php echo ($data['company_access'] == 1) ? "" : "red-status";  ?>">
                    </span>
                    <?php echo ($data['company_access'] == 1) ? "Access enabled" : "Access disabled";  ?>
                </div>
            </div>
            <?php
            if ($roundDataArray['roundNumber'] != NULL) {
                // Need Round Constraints
                $hrefStatus = $roundDataArray['hrefStatus'];
                $elementClass = $roundDataArray['disabledClass'];
            } else {
                // No need of round constraints
                $hrefStatus = URLROOT . 'companies/manage-company/change-access';
                $elementClass = "";
            }
            ?>
            <button disabled class="common-blue-btn <?php echo $elementClass; ?>">
                <a href="<?php echo $hrefStatus; ?>">
                    Update
                </a>

            </button>
        </div>
        <div class="manage-company-top-right display-flex-row">
            <a href="<?php echo URLROOT . 'register/register-company'; ?>" class="common-blue-btn display-flex-row">
                <span class="material-symbols-outlined">
                    add_to_photos
                </span>
                Register Company</a>
            <a href="<?php echo URLROOT . 'companies/manage-company/blacklisted'; ?>" class="common-blue-btn display-flex-row" id="blacklist-company-btn">
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
                    <?php foreach ($data['company_list'] as $company) : ?>
                        <tr>
                            <td><?php echo $company->company_name ?></td>
                            <td><?php echo $company->username ?></td>
                            <td><?php echo $company->email ?></td>
                            <td><?php echo $company->contact ?></td>
                            <td><a href="<?php echo URLROOT . 'pdc/main-company-details/' . $company->user_id; ?>">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</section>

<!-- VIEW  BLACKLISTED COMPANIES MODAL -->
<div class="common-modal-box blacklisted-main-modal <?php echo $data['blacklisted_modal_class']; ?>">
    <div class="display-flex-col blacklisted-main-div">

        <div class="display-flex-col blacklisted-companies-modal">
            <div class="top-bar display-flex-row">
                <h3>Blacklisted Company List</h3>
                <a href="<?php echo URLROOT . 'companies/manage-company'; ?>">
                    <span class="material-symbols-outlined">
                        close
                    </span></a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Contact Person</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if ($data['blacklisted_list'] == NULL) {
                        echo '<p id="no-blacklist-msg"> No Blacklisted companies to show yet </p>';
                    } else {
                        foreach ($data['blacklisted_list'] as $blacklisted) {
                            echo "<tr>";
                            echo "<td>" . $blacklisted->company_name . "</td>";
                            echo "<td>" . $blacklisted->username . "</td>";
                            echo "<td>" . $blacklisted->email . "</td>";
                            echo "<td>" . $blacklisted->contact . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- VIEW  UPDATE ACCESS MODAL -->
<div class="common-modal-box <?php echo $data['change_access_modal']; ?>">
    <div class="std-batches-add display-flex-col" id="change-access-modal">
        <a href="<?php echo URLROOT . 'companies/manage-company'; ?>" id="modal-box-close">
            <span class="material-symbols-outlined" class="common-modal-close">
                close
            </span></a>

        <form action="<?php echo URLROOT . 'pdc/update-companies-system-access' ?>" id="add-student-batch" class="display-flex-col common-modal-box-form" method="POST">
            <h3>Change Companies System Access </h3>
            <div class="display-flex-row">
                <label for="company_access">STATUS</label>
                <select name="access" id="status-dropdown" class="common-input" onchange="this.form.submit()">
                    <option value="" selected disabled></option>
                    <option value="1">Enable Access</option>
                    <option value="0">Disable Access</option>
                </select>
            </div>
        </form>
    </div>


</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>