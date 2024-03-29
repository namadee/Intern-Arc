<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
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
                    Current Batch Year is <span id="current_batchyear_advertisement_span"><?php echo $_SESSION['batchYear'] ?></span>

                </p>
            </div>

            <!-- Common Search Bar Style-->
            <form action="javascript:void(0)" class="common-search-bar display-flex-col">
                <div class="display-flex-row">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                    <input class="common-input" type="text" name="search-item" id="pdc_advertisement_search" placeholder="Search Advertisement">
                </div>

                <div class="common-search-result display-flex-col" id="pdc_advertisement_result">

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
                    <th id="action-th"></th>

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
                            <?php
                            //Special Case where advertisement status cannot be changed after round 1 starting date 
                            // Therfore once round 1 start cannot change the status of advertisements
                            $roundTableData =  $roundDataArray['roundTableData'];
                            $currentDate = $roundDataArray['currentDate'];


                            if ($roundTableData[0]->start_date == NULL) {
                                $elementStatus = "";
                            } else if ($roundTableData[0]->start_date <= $currentDate) {
                                // Need Round Constraints
                                $elementStatus = "disabled";
                            } else {
                                // No need of round constraints
                                $elementStatus = "";
                            }
                            ?>
                            <td>
                                <form action="<?php echo URLROOT . 'pdc/reviewAdvertisement/' . $advertisement->advertisement_id ?>" method="POST">
                                    <select <?php echo $elementStatus; ?> name="status" class="common-input" onchange="this.form.submit()">
                                        <option value="" selected disabled></option>
                                        <option value="approved">Approve</option>
                                        <option value="rejected">Reject</option>
                                    </select>
                                </form>
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