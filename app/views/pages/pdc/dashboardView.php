<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('login_success'); ?>

    <div class="display-flex-row main-dashboard-topbar">
        <div class="dashboard-topbar display-flex-col">
            <div class="dash-top-left display-flex-row ">
                <span class="material-symbols-outlined">
                    campaign
                </span>
                <p>1st Round : 01/11/2023 to 10/04/2023</p>
            </div>
            <div class="dash-top-right display-flex-row ">
                <span class="material-symbols-outlined">
                    campaign
                </span>
                <p>2nd Round : 01/11/2023 to 10/04/2023</p>
            </div>

        </div>
        <div class="dashboard-topbar-btns display-flex-row">
            <a href="<?php echo URLROOT . 'pdc/send-invitation'; ?>" class="send-invitation display-flex-row common-blue-btn">
                <span class="material-symbols-outlined">
                    mail
                </span>
                Send Invitation
            </a>

            <a href="<?php echo URLROOT . 'pdc/index/set-duration'; ?>" class="round-period display-flex-row common-blue-btn">
                <span class="material-symbols-outlined">
                    published_with_changes
                </span>
                Set Round Periods
            </a>
        </div>
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
            <a href="<?php echo URLROOT . 'pdc/review-advertisement'  ?>" class="common-blue-btn view-all-btn">View All</a>

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

    <div class="common-modal-box <?php echo $data['duration-modal']; ?>" id="set-round-modal-box">
        <form method="POST" action="" class="display-flex-col common-modal-box-form" onSubmit="if(!confirm('Please double check before submitting dates! Do you want to proceed?')){return false;}">
            <a href="<?php echo URLROOT . "pdc" ?> ">
                <span class="material-symbols-outlined" class="common-modal-close">
                    close
                </span></a>
            <h3>Set Round Durations</h3>
            <ul class="display-flex-col">
                <li class="display-flex-col">
                    <p>First Round Period</p>
                    <div class="display-flex-row date-period">
                        <input type="date" name="first-round-start" id="first-round-start" class="common-input" value="" placeholder="Start Date">
                        <span> - </span>
                        <input type="date" name="first-round-end" id="first-round-end" class="common-input" value="" placeholder="End Date">
                    </div>
                </li>
                <li class="display-flex-col">
                    <p>Second Round Period</p>
                    <div class="display-flex-row date-period">
                        
                        <input type="date" name="second-round-start" id="second-round-start" class="common-input" value="">
                        <span> - </span>
                        <input type="date" name="second-round-end" id="second-round-end" class="common-input" value="">
                    </div>
                </li>
            </ul>

            <button type="submit" class="common-blue-btn" id="set-duration-btn">Set Date</button>
            <p id="duration-note">Please note that you can not change the dates after you submit the form! Please double check before submitting dates</p>

        </form>
    </div>
</section>




<?php require APPROOT . '/views/includes/footer.php'; ?>