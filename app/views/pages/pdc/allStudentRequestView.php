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
                    <form method="GET" class="display-flex-row">
                        <span class="material-symbols-rounded">
                            filter_alt
                        </span>
                        <select name="filter-list" id="filterlist" onchange="location = this.value;">
                            <?php if ($data['round'] == 1) {
                                $roundOne = "selected";
                                $roundTwo = "";
                            } else {
                                $roundOne = "";
                                $roundTwo = "selected";
                            } ?>
                            <option value="http://localhost/internarc/pdc/student-requests-list/1" <?php echo $roundOne ?>> Round 1</option>
                            <option value="http://localhost/internarc/pdc/student-requests-list/2" <?php echo $roundTwo ?>>Round 2</option>
                        </select>
                    </form>
                </div>
            </div>

            <button class="common-blue-btn download-rej-list"><a href="<?php echo URLROOT.'pdc/downloadRejectedStudentList/' ?>" target="_blank">Download Rejected List</a></button>
        </div>
        <div class="display-flex-row student-request-body">
            <div class="student-requests-box display-flex-col">
                <div class="display-flex-row container-top">
                    <h3>CS Students</h3>
                    <!-- Common Search Bar Style-->
                    <form action="javascript:void(0)" class="common-search-bar display-flex-col">
                        <div class="display-flex-row">
                            <span class="material-symbols-rounded">
                                search
                            </span>
                            <input class="common-input" type="text" name="search-item" id="pdc_request_cs_search" placeholder="Search Index Number" data-cs-stream="CS" data-batch-year="<?php echo $_SESSION['batchYear']; ?>" data-round="<?php echo $data['round']; ?>">
                        </div>

                        <div class="common-search-result display-flex-col" id="pdc_request_cs_result">

                        </div>
                    </form>
                </div>
                <table class="student-list">
                    <tr class="top-header">
                        <th>
                            Index Number
                        </th>
                        <th>
                            Student Status
                        </th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($data['studentRequestsCS'] as $studentRequest) : ?>
                        <tr>
                            <td><?php echo $studentRequest->index_number; ?></td>

                            <td>
                                <?php if ($studentRequest->student_status == 0) {
                                    $finalStatus = "Pending";
                                    $divClass = "yellow-status-font";
                                    $spanClass = "yellow-status";
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
                                <a href="<?php echo URLROOT . 'pdc/request-list-by-student/' . $data['round'] . '/' . $studentRequest->student_id; ?>" class="orange-view-btn">View</a>
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
                    <form action="javascript:void(0)" class="common-search-bar display-flex-col">
                        <div class="display-flex-row">
                            <span class="material-symbols-rounded">
                                search
                            </span>
                            <input class="common-input" type="text" name="search-item" id="pdc_request_is_search" placeholder="Search Index Number">
                        </div>

                        <div class="common-search-result display-flex-col" id="pdc_request_is_result">

                        </div>
                    </form>
                </div>
                <table class="student-list">
                    <tr class="top-header">
                        <th>
                            Index Number
                        </th>
                        <th>
                            Student Status
                        </th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($data['studentRequestsIS'] as $studentRequest) : ?>
                        <tr>
                            <td><?php echo $studentRequest->index_number; ?></td>

                            <td>
                                <?php if ($studentRequest->student_status == 0) {
                                    $finalStatus = "Pending";
                                    $divClass = "yellow-status-font";
                                    $spanClass = "yellow-status";
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
                                <a href="<?php echo URLROOT . 'pdc/request-list-by-student/' . $data['round'] . '/' . $studentRequest->student_id; ?>" class="orange-view-btn">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>