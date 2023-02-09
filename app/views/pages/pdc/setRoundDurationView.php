<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">

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
        <a href="" class="send-invitation display-flex-row common-blue-btn">
            <span class="material-symbols-outlined">
                mail
            </span>
            Send Invitation
        </a>

        <a href="" class="round-period display-flex-row common-blue-btn">
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
                <tbody>
                    <tr>
                        <td>99x Technology</td>
                        <td>Software Engineering</td>
                        <td>5 interns</td>
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
                        <td>5 interns</td>
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
                        <td>5 interns</td>
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
                        <td>5 interns</td>
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
    <div class="common-modal-box" id="set-round-modal-box">
        <form method="POST" action="" class="display-flex-col">
            <a href="<?php echo URLROOT . "pdc" ?> ">
                <span class="material-symbols-outlined" class="common-modal-close">
                    close
                </span></a>
            <h3>Set Round Durations</h3>
                <ul class="display-flex-col">
                <li class="display-flex-col">
                    <p>First Round Period</p>
                    <div class="display-flex-row date-period">
                        <input type="date" name="first-round-start" id="first-round-start" class="common-input" value="">
                        <span> - </span>
                        <input type="date" name="first-round-end" id="first-round-end" class="common-input" value="">
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

            <button type="submit" class="common-blue-btn">Set Date</button>
        </form>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>