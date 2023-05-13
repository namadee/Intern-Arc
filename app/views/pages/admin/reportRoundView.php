<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="display-flex-col student-request-container round-report-div">
        <div class="display-flex-row student-request-top">
            <h2>Round Reports</h2>
            <div class="display-flex-row top-round-select-div">
                <p>Select Round: </p>
                <div>
                    <div class="common-filter">
                        <form class="display-flex-row">
                            <span class="material-symbols-rounded">
                                filter_alt
                            </span>
                            <select name="filter-list" id="reportRoundSelect">
                                <?php if ($data['round'] == 1) {
                                    $roundOne = "selected";
                                    $roundTwo = "";
                                } else {
                                    $roundOne = "";
                                    $roundTwo = "selected";
                                } ?>
                                <option value="1" <?php echo $roundOne ?>> Round 1</option>
                                <option value="2" <?php echo $roundTwo ?>>Round 2</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="batchYearSelectDiv display-flex-row">
                    <label for="year">Batch Year</label>
                    <select name="year" class="common-input" id="reportBacthYearSelect">
                        <?php foreach ($data['studentBatches'] as $batch) : ?>
                            <?php  $selected = ($batch->batch_year == $data['batchYear']) ? 'selected' : ''; ?>

                            <option <?php echo $selected ?>  value="<?php echo $batch->batch_year ?>"><?php echo $batch->batch_year ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button id="report-round-search-btn" class="common-blue-btn"><a id="search-element-round-report-btn">Search</a></button>
                    <button id="secondary-grey-btn"><a href="<?php echo URLROOT . 'admin/get-round-reports'; ?>" class="display-flex-row" id="reset-btn"><span class="material-symbols-outlined">
                                restart_alt
                            </span>Reset</a></button>
                </div>
            </div>

        </div>
        <div class="display-flex-row student-request-body">
            <div class="student-requests-box display-flex-col">
                <div class="display-flex-col container-top">
                    <div class="display-flex-row top-bar-1">
                        <h3>CS Students</h3>
                        <button class="download-report-btn"><a href="<?php echo URLROOT.'admin/downloadRoundReport/'.$data['batchYear']. '/' . $data['round']. '/' . 'CS'?>" target="_blank">Download Report</a></button>
                    </div>
                    <div class="display-flex-col top-bar-1">
                        <p>Number of Students: <?php echo $data['CSCount']; ?></p>
                        <p>Number of Recruited Students <?php echo $data['CSRecruitedCount']; ?></p>
                    </div>

                </div>
                <table class="student-list">
                    <tr class="top-header">
                        <th>
                            Index Number
                        </th>
                        <th>
                            Registration Number
                        </th>
                        <th>Student Name</th>
                    </tr>
                    <?php foreach ($data['studentRequestsCS'] as $studentRequest) : ?>
                        <tr>
                            <td><?php echo $studentRequest->index_number; ?></td>
                            <td><?php echo $studentRequest->registration_number; ?></td>
                            <td><?php echo $studentRequest->username; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- IS Student Requests List -->
            <div class="student-requests-box display-flex-col">
                <div class="display-flex-col container-top">
                    <div class="display-flex-row top-bar-1">
                        <h3>IS Students</h3>
                        <button class="download-report-btn"><a href="<?php echo URLROOT.'admin/downloadRoundReport/'.$data['batchYear']. '/' . $data['round']. '/' . 'IS'?>" target="_blank">Download Report</a></button>
                    </div>

                    <div class="display-flex-col top-bar-1">
                        <p>Number of Students: <?php echo $data['ISCount']; ?></p>
                        <p>Number of Recruited Students <?php echo $data['ISRecruitedCount']; ?></p>
                    </div>
                </div>
                <table class="student-list">
                    <tr class="top-header">
                        <th>
                            Index Number
                        </th>
                        <th>
                            Registration Number
                        </th>
                        <th>Student Name</th>
                    </tr>
                    <?php foreach ($data['studentRequestsIS'] as $studentRequest) : ?>
                        <tr>
                            <td><?php echo $studentRequest->index_number; ?></td>
                            <td><?php echo $studentRequest->registration_number; ?></td>
                            <td><?php echo $studentRequest->username; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>