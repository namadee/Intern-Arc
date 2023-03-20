<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('login_success'); ?>
    <div class="dashboard-topbar display-flex-row">

        <div class="dash-top-left">
            <p>Ending Date of First Round : 01/11/2022</p>
        </div>
        <div class="dash-top-right ">
            <a href="" class="display-flex-row">
                <span class="material-symbols-outlined">
                    campaign
                </span>
                <p>Set 2nd Round Period</p>
            </a>
        </div>
    </div>
    <div class="dashboard-topbar-btns display-flex-row">
        <a href="<?php echo URLROOT . 'pdc/send-invitation'; ?>" class="send-invitation display-flex-row common-blue-btn">
            <span class="material-symbols-outlined">
                mail
            </span>
            Send Invitation
        </a>

        <a href="<?php echo URLROOT . 'pdc/set-round-durations'; ?>" class="round-period display-flex-row common-blue-btn">
            <span class="material-symbols-outlined">
                published_with_changes
            </span>
            Set Round Periods
        </a>
    </div>
    <div class="dashboard-cards display-flex-row">
        <div class="display-flex-row">
            <span></span>
            <p class="dashboard-card-item">Total Registered Companies</p>
            <p class="dashboard-card-total"><?php echo $data['companyCount']; ?></p>
        </div>
        <div class="registered-companies display-flex-row">
            <span></span>
            <p class="dashboard-card-item">Total Registered Students</p>
            <p class="dashboard-card-total"><?php echo $data['studentCount']; ?></p>
        </div>
    </div>

    <div class="dashboard-advertisement-list display-flex-col">
        <div class="list-top display-flex-row">
            <h3>Internship Advertisements</h3>
            <a href="<?php echo URLROOT.'pdc/review-advertisement'  ?>" class="common-blue-btn view-all-btn">View All</a>

        </div>
        <div class="list-body">
            <table>
                <thead>
                    <th>Advertisement Name</th>
                    <th>Company Name</th>
                    <th>Interns</th>
                    <th>Status</th>

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
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>