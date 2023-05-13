<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="company-content-container display-flex-col">
        <div class="company-content-top display-flex-row">
            <h2>Company List</h2>
            <!-- Common Search Bar Style-->
            <form action="javascript:void(0)" class="common-search-bar display-flex-col">
                <div class="display-flex-row">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                    <input class="common-input" type="text" name="search-item" id="admin_search_company" placeholder="Search Company">
                </div>

                <div class="common-search-result display-flex-col" id="admin_company_result">

                </div>
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
                            <td><a href="<?php echo URLROOT . 'admin/main-company-details/' . $company->user_id; ?>">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <div>
        <button class="common-blue-btn blacklisted-company-btn" onclick="window.location.href = '<?php echo URLROOT . 'admin/deactivated-companies' ?>';">Deactivated Companies</button>
    </div>
</section>





<?php require APPROOT . '/views/includes/footer.php'; ?>