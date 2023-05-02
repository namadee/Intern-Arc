<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="display-flex-col student-requests-list-container">
        <div class="top-container display-flex-row">
            <h2>Applied Adevertisements - Round 1</h2>
            <a href="" class="common-blue-btn"> View Profile</a>
        </div>

        <div class="middle-container display-flex-row">
            <ul class="display-flex-col">
                <li class="display-flex-row">
                    <p>Name</p>
                    <p class="detail-item">Ruchira Bogahawatta</p>
                </li>

                <li class="display-flex-row">
                    <p>Index Number</p>
                    <p class="detail-item">20021097</p>
                </li>
                <li class="display-flex-row">
                    <p>Registration Number</p>
                    <p class="detail-item">2020/IS/109</p>
                </li>
                <li class="display-flex-row">
                    <p>Stream</p>
                    <p class="detail-item">Information Systems</p>
                </li>
            </ul>
        </div>

        <div class="bottom-container display-flex-col">

            <ul class="display-flex-col">
                <li class="display-flex-row ">
                    <div class="display-flex-row request-row">
                        <p>Virtusa - Software Engineer</p>
                        <div class="common-status display-flex-row">
                            <span class="common-status-span">
                            </span>
                            Recruited
                        </div>
                    </div>
                    <a href="" class="common-view-btn"> View </a>
                </li>
                <li class="display-flex-row ">
                    <div class="display-flex-row request-row">
                        <p>Virtusa - Software Engineer</p>
                        <div class="common-status display-flex-row">
                            <span class="common-status-span">
                            </span>
                            Recruited
                        </div>
                    </div>
                    <a href="" class="common-view-btn"> View </a>
                </li>
                <li class="display-flex-row ">
                    <div class="display-flex-row request-row">
                        <p>Virtusa - Software Engineer</p>
                        <div class="common-status display-flex-row red-status-font">
                            <span class="common-status-span red-status">
                            </span>
                            Rejected
                        </div>
                    </div>
                    <a href="" class="common-view-btn"> View </a>
                </li>
                <li class="display-flex-row ">
                    <div class="display-flex-row request-row ">
                        <p>Virtusa - Software Engineer</p>
                        <div class="common-status display-flex-row yellow-status-font">
                            <span class="common-status-span yellow-status">
                            </span>
                            Pending
                        </div>
                    </div>
                    <a href="" class="common-view-btn"> View </a>
                </li>
                <li class="display-flex-row ">
                    <div class="display-flex-row request-row">
                        <p>Virtusa - Software Engineer</p>
                        <div class="common-status display-flex-row">
                            <span class="common-status-span">
                            </span>
                            Recruited
                        </div>
                    </div>
                    <a href="" class="common-view-btn"> View </a>
                </li>

            </ul>
        </div>
    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>