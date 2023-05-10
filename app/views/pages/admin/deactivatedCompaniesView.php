<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="company-content-container display-flex-col">
        <div class="company-content-top display-flex-row">
            <h2>Deactivated Company List</h2>
        </div>
        <div class="manage-company-table">
            <?php if (empty($data['deactivated_companies'])) : ?>
                <p>There are currently no deactivated companies in the system</p>

            <?php else : ?>
                <table>
                    <thead>
                        <th>Company Name</th>
                        <th>Contact Person</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th id="action-th"></th>

                    </thead>
                    <tbody>
                        <?php foreach ($data['deactivated_companies'] as $company) : ?>
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
            <?php endif; ?>
        </div>

    </div>
</section>





<?php require APPROOT . '/views/includes/footer.php'; ?>