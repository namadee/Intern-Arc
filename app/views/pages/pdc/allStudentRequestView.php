<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="display-flex-col student-request-container">
        <div class="display-flex-row student-request-top">
            <h2>Requests</h2>
            <div class="display-flex-row">
                <p>Select Round: </p>
                <div class="common-filter">
                    <form action="" class="display-flex-row">
                        <span class="material-symbols-rounded">
                            filter_alt
                        </span>
                        <select name="filter-list" id="filterlist">
                            <?php if ($data['round'] == 1) {
                                $roundOne = "selected";
                                $roundTwo = "";
                            } else {
                                $roundOne = "";
                                $roundTwo = "selected";
                            } ?>
                            <option value="1" <?php echo $roundOne ?> >Round 1</option>
                            <option value="2" <?php echo $roundTwo ?>>Round 2</option>
                        </select>
                    </form>
                </div>
            </div>

        </div>
        <div class="display-flex-row student-request-body">
            <div class="student-requests-box display-flex-col">
                <div class="display-flex-row container-top">
                    <h3>CS Students</h3>
                    <!-- Common Search Bar Style-->
                    <form action="" class="common-search-bar display-flex-row">
                        <span class="material-symbols-rounded">
                            search
                        </span>
                        <input class="common-input" type="text" name="search-item" placeholder="Search Student">
                    </form>
                </div>
                <div class="common-filter">
                    <form action="" class="display-flex-row">
                        <span class="material-symbols-rounded">
                            filter_alt
                        </span>
                        <select name="filter-list" id="filterlist">
                            <option value="all" selected>All</option>
                            <option value="name">Recruited</option>
                            <option value="name">Rejected</option>
                        </select>
                    </form>
                </div>
                <table class="student-list">
                    <?php foreach ($data['studentRequestsCS'] as $studentRequest) : ?>
                        <tr>
                            <td><?php echo $studentRequest->registration_number; ?></td>

                            <td>
                                <?php if ($studentRequest->student_status == 0) {
                                    $finalStatus = "Rejected";
                                    $divClass = "red-status-font";
                                    $spanClass = "red-status";
                                } else {
                                    $finalStatus = "Recruited";
                                    $divClass = "";
                                    $spanClass = "";
                                }
                                ?>
                                <div class="common-status display-flex-row <?php echo $divClass; ?>">
                                    <span class="common-status-span <?php echo $spanClass; ?>">
                                    </span>
                                    <?php echo $finalStatus; ?>
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo URLROOT . 'pdc/view-request-list-by-student/' . $studentRequest->student_id; ?>" class="orange-view-btn">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- IS Student Requests List -->
            <div class="student-requests-box display-flex-col">
                <div class="display-flex-row container-top">
                    <h3>IS Students</h3>
                    <!-- Common Search Bar Style-->
                    <form action="" class="common-search-bar display-flex-row">
                        <span class="material-symbols-rounded">
                            search
                        </span>
                        <input class="common-input" type="text" name="search-item" placeholder="Search Student">
                    </form>
                </div>
                <div class="common-filter">
                    <form action="" class="display-flex-row">
                        <span class="material-symbols-rounded">
                            filter_alt
                        </span>
                        <select name="filter-list" id="filterlist">
                            <option value="all" selected>All</option>
                            <option value="name">Recruited</option>
                            <option value="name">Rejected</option>
                        </select>
                    </form>
                </div>
                <table class="student-list">
                    <?php foreach ($data['studentRequestsIS'] as $studentRequest) : ?>
                        <tr>
                            <td><?php echo $studentRequest->registration_number; ?></td>

                            <td>
                                <?php if ($studentRequest->student_status == 0) {
                                    $finalStatus = "Rejected";
                                    $divClass = "red-status-font";
                                    $spanClass = "red-status";
                                } else {
                                    $finalStatus = "Recruited";
                                    $divClass = "";
                                    $spanClass = "";
                                }
                                ?>
                                <div class="common-status display-flex-row <?php echo $divClass; ?>">
                                    <span class="common-status-span <?php echo $spanClass; ?>">
                                    </span>
                                    <?php echo $finalStatus; ?>
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo URLROOT . 'pdc/view-request-list-by-student/' . $studentRequest->student_id; ?>" class="orange-view-btn">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>