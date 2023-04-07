<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('company_list_msg') ?>
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


    <?php require APPROOT . '/views/includes/footer.php'; ?>