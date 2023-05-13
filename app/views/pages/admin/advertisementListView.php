<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('advertisement_status'); ?>
    <div class="company-content-container display-flex-col pdc-advertisementlist">
        <div class="company-content-top display-flex-row">
            <div class="display-flex-row">
                <h2>Advertisement List</h2>
                <p class="display-flex-row" id="student-batch-current-year">
                    <span id="student-batch-year-span" class="material-symbols-outlined">
                        where_to_vote
                    </span>
                    Current Batch Year is <span id="current_batchyear_advertisement_span_admin"><?php echo $_SESSION['batchYear'] ?></span>

                </p>
            </div>

            <!-- Common Search Bar Style-->
            <form action="javascript:void(0)" class="common-search-bar display-flex-col">
                <div class="display-flex-row">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                    <input class="common-input" type="text" name="search-item" id="admin_advertisement_search" placeholder="Search Advertisement">
                </div>

                <div class="common-search-result display-flex-col" id="admin_advertisement_result">
                </div>
            </form>

        </div>
        <div class="manage-company-table">
            <table>
                <thead>
                    <th>Advertisement Position</th>
                    <th>Company Name</th>
                    <th>Interns</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach ($data['advertisementList'] as $advertisement) : ?>
                        <tr>
                            <td><?php echo $advertisement->position ?></td>
                            <td><?php echo $advertisement->company_name ?></td>
                            <td><?php echo $advertisement->intern_count ?></td>
                            <td>

                                <div class="common-status display-flex-row <?php echo $advertisement->status == 'pending' ? 'yellow-status-font' : ($advertisement->status == 'rejected' ? 'red-status-font' : ''); ?> ">

                                    <span class="common-status-span <?php echo $advertisement->status == 'pending' ? 'yellow-status' : ($advertisement->status == 'rejected' ? 'red-status' : ''); ?>">
                                    </span>
                                    <?php echo ucfirst($advertisement->status); ?>
                                </div>

                            </td>
                            <td><a href="<?php echo URLROOT . 'advertisements/viewAdvertisement/' . $advertisement->advertisement_id ?>">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>