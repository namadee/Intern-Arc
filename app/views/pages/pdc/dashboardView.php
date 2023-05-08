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
                <?php
                $roundPeriod = $data['roundDetails'];

                if ($roundPeriod[0]->start_date == NULL || $roundPeriod[0]->end_date == NULL || $roundPeriod[1]->start_date == NULL || $roundPeriod[1]->end_date == NULL) {
                    $roundPeriodOneData = 'Not set yet';
                    $roundPeriodTwoData = 'Not set yet';
                    $roundOneLoadingIcon = '';
                    $roundTwoLoadingIcon = '';
                } else {

                    //For loading icon
                    if ($roundDataArray['roundNumber'] == 1) {
                        $roundOneLoadingIcon = '<span class="material-symbols-outlined" id="loading-material-icon"> autorenew </span>';
                        $roundTwoLoadingIcon = '';
                    } else if ($roundDataArray['roundNumber'] == 2) {
                        $roundOneLoadingIcon = '';
                        $roundTwoLoadingIcon = '<span class="material-symbols-outlined" id="loading-material-icon"> autorenew </span>';
                    } else {
                        $roundOneLoadingIcon = '';
                        $roundTwoLoadingIcon = '';
                    }
                    foreach ($roundPeriod as $period) {
                        if ($period->round_no == 1) {
                            $roundPeriodOneData = $period->start_date . ' to ' . $period->end_date;
                        } else {
                            $roundPeriodTwoData = $period->start_date . ' to ' . $period->end_date;
                        }
                    }
                }

                ?>
                <p id="dashboard-round-date-data">
                    1st Round :
                </p>
                <span id="dashboard-round-date" class="display-flex-row"><?php echo $roundPeriodOneData ?>
                    <?php echo $roundOneLoadingIcon ?>
                </span>

            </div>
            <div class="dash-top-right display-flex-row">
                <span class="material-symbols-outlined">
                    campaign
                </span>
                <p id="dashboard-round-date-data">2nd Round :</p>
                <span id="dashboard-round-date" class="display-flex-row"><?php echo $roundPeriodTwoData ?>
                    <?php echo $roundTwoLoadingIcon ?>
                </span>
            </div>

        </div>
        <div class="dashboard-topbar-btns display-flex-row">
            <a href="<?php echo URLROOT . 'pdc/send-invitation'; ?>" class="send-invitation display-flex-row common-blue-btn">
                <span class="material-symbols-outlined">
                    mail
                </span>
                Send Invitation
            </a>
            <?php
            if ($roundDataArray['roundNumber'] != NULL) {
                // Need Round Constraints
                $hrefStatus = $roundDataArray['hrefStatus'];
                $elementClass = $roundDataArray['disabledClass'];
            } else {
                // No need of round constraints
                $hrefStatus = URLROOT . 'pdc/index/set-duration';
                $elementClass = "";
            }
            ?>
            <a href="<?php echo $hrefStatus; ?>" class="round-period display-flex-row common-blue-btn <?php echo $elementClass; ?>">
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
                <thead id="thead-dashboard">
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
        <form method="POST" action="<?php echo URLROOT . 'pdc/setRoundPeriod'; ?>" class="display-flex-col common-modal-box-form" onSubmit="if(!confirm('Please double check before submitting dates! Do you want to proceed?')){return false;}">
            <a href="<?php echo URLROOT . "pdc" ?> ">
                <span class="material-symbols-outlined" class="common-modal-close">
                    close
                </span></a>
            <h3>Set Round Durations</h3>
            <p id="set-round-year-box">Current Batch Year : <span>2020</span></p>
            <ul class="display-flex-col">
                <li class="display-flex-col">
                    <p class="period-header">First Round Period</p>
                    <div class="display-flex-row date-period">
                        <div class="display-flex-col">
                            <label for="first_round_start">Start Date</label>
                            <input type="date" name="first_round_start" id="first_round_start" class="common-input" placeholder="Start Date" required>

                        </div>
                        <span> - </span>
                        <div class="display-flex-col">
                            <label for="first_round_end">End Date</label>
                            <input type="date" name="first_round_end" id="first_round_end" class="common-input" placeholder="End Date" required>

                        </div>
                    </div>
                </li>
                <hr>
                <li class="display-flex-col ">
                    <p class="period-header">Second Round Period</p>
                    <div class="display-flex-row date-period">
                        <div class="display-flex-col">
                            <label for="second_round_start">Start Date</label>
                            <input type="date" name="second_round_start" id="second_round_start" class="common-input" required>

                        </div>
                        <span> - </span>
                        <div class="display-flex-col">
                            <label for="second_round_end">End Date</label>
                            <input type="date" name="second_round_end" id="second_round_end" class="common-input" required>

                        </div>
                    </div>
                </li>
            </ul>

            <button type="submit" class="common-blue-btn" id="set-duration-btn">Set Date</button>
            <p id="duration-note">Please note that you can not change the dates after the round 1 starts! Please double check before submitting dates</p>

        </form>
    </div>

</section>




<?php require APPROOT . '/views/includes/footer.php'; ?>