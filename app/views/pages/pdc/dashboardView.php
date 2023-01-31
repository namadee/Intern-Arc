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
            <p class="dashboard-card-total">180</p>
        </div>
        <div class="registered-companies display-flex-row">
            <span></span>
            <p class="dashboard-card-item">Total Registered Students</p>
            <p class="dashboard-card-total">180</p>
        </div>
    </div>

    <div class="dashboard-advertisement-list display-flex-col">
        <div class="list-top display-flex-row">
            <h3>Internship Advertisements</h3>
            <div class="common-filter display-flex-row">
                <span class="material-symbols-rounded">
                    filter_alt
                </span>
                <form action="">
                    <select name="filter-list" id="filterlist">
                        <option value="all" selected>All</option>
                        <option value="name">name</option>
                        <option value="name">name</option>
                        <option value="name">name</option>
                    </select>
                </form>
            </div>

        </div>
        <div class="list-body">
            <table>
                <thead>
                    <th>Company Name</th>
                    <th>Position</th>
                    <th>Interns</th>
                    <th>Status</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr>
                        <td>99x Technology</td>
                        <td>Software Engineering</td>
                        <td>5</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="">View</a></td>
                    </tr>
                    <tr>
                        <td>99x Technology</td>
                        <td>Software Engineering</td>
                        <td>5</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="">View</a></td>
                    </tr>
                    <tr>
                        <td>99x Technology</td>
                        <td>Software Engineering</td>
                        <td>5</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="">View</a></td>
                    </tr>
                    <tr>
                        <td>99x Technology</td>
                        <td>Software Engineering</td>
                        <td>5</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="">View</a></td>
                    </tr>
                    <tr>
                        <td>99x Technology</td>
                        <td>Software Engineering</td>
                        <td>5</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="">View</a></td>
                    </tr>
                    <tr>
                        <td>99x Technology</td>
                        <td>Software Engineering</td>
                        <td>5</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="">View</a></td>
                    </tr>
                    <tr>
                        <td>99x Technology</td>
                        <td>Software Engineering</td>
                        <td>5</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="">View</a></td>
                    </tr>
                    <tr>
                        <td>99x Technology</td>
                        <td>Software Engineering</td>
                        <td>5</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="">View</a></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>