<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('student_batch_msg'); ?>
    <div class="student-batches-container display-flex-col">
        <div class="student-batches-top display-flex-row">
            <h2>Student Batches</h2>
            <a href='<?php echo URLROOT . 'students/manage-student/student-batch' ?>' class="common-blue-btn display-flex-row">
                <span class="material-symbols-outlined">
                    library_add
                </span>
                Add Batch</a>


        </div>
        <div class="student-batches-table">
            <table>
                <thead>
                    <tr>
                        <th>Batch Year</th>
                        <th>CS Count</th>
                        <th>IS Count</th>

                        <th class="student-batch-status">
                            <div class="display-flex-row">
                                System Access
                                <span class="material-symbols-outlined tooltip">
                                    help
                                    <p class="tooltiptext">Determine whether the students can logged <br> in to the system or not</p>
                                </span>
                            </div>
                        </th>


                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($data['batch_list'] as $batch) : ?>
                        <tr>
                            <td><?php echo $batch->batch_year  ?> Batch</td>
                            <td><?php echo $batch->cs_count  ?> students</td>
                            <td><?php echo $batch->is_count  ?> students</td>

                            <td>
                                <div class="common-status display-flex-row <?php echo $batch->access === '1' ? '' : 'red-status-font'; ?>">

                                    <span class="common-status-span <?php echo $batch->access === '1' ? '' : 'red-status'; ?>">
                                    </span>
                                    <?php echo ($batch->access == "1") ? "Access enabled" : "Access disabled"; ?>
                                </div>
                            </td>
                            <?php
                            if ($roundDataArray['roundNumber'] != NULL) {
                                // Need Round Constraints
                                $hrefStatus = $roundDataArray['hrefStatus'];
                                $elementClass = $roundDataArray['disabledClass'];
                            } else {
                                // No need of round constraints
                                $hrefStatus = URLROOT . 'students/manage-student/change-access/' .  $batch->batch_year;
                                $elementClass = "";
                            }
                            ?>
                            <td> <a href="<?php echo URLROOT . 'students/manage-student/view-batch/' . $batch->batch_year ?>" class="student-batches-btn">View</a></button></td>
                            <td>
                                <button class="<?php echo $elementClass; ?>"> <a href="<?php echo $hrefStatus; ?>">Change Access</a></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- ADD BATCH MODAL -->
        <div class="common-modal-box <?php echo $data['add_modal_class']; ?>">
            <div class="std-batches-add display-flex-col">
                <a href="<?php echo URLROOT . 'students/manage-student' ?>" id="modal-box-close">
                    <span class="material-symbols-outlined" class="common-modal-close">
                        close
                    </span></a>

                <form action="<?php echo URLROOT . 'students/manageStudentBatch' ?>" id="add-student-batch" class="display-flex-col common-modal-box-form" method="POST">
                    <h3>Add a New Batch</h3>
                    <div class="display-flex-row">
                        <label for="batch-year">Enter Batch Year</label>
                        <input type="number" name="batch_year" class="common-input" id="batch-year-input" required>
                    </div>
                    <button type="submit" name="add_form_submit" class="common-blue-btn" id="modal-submit-btn">Add</button>
                </form>
                <span id="validate-error"></span>
            </div>


        </div>

        <!-- VIEW BATCH MODAL -->
        <div class="common-modal-box <?php echo $data['view-modal-class']; ?>">
            <div class="std-batches-add display-flex-col" id="view-batch-modal">
                <a href="<?php echo URLROOT . 'students/manage-student' ?>" id="modal-box-close">
                    <span class="material-symbols-outlined" class="common-modal-close">
                        close
                    </span></a>

                <div class="display-flex-col view-batch-div">
                    <h2><?php echo $data['batch_year']; ?> Batch</h2>
                    <hr>
                    <ul class="display-flex-col">
                        <li class="display-flex-row">
                            <p>Information System Students</p>
                            <a class="common-blue-btn" href="<?php echo URLROOT . 'register/register-student/' . $data['batch_year'] . '/IS' ?>">Add Students</a>
                            <a class="common-blue-btn" href="<?php echo URLROOT . 'pdc/student-list/' . $data['batch_year'] . '/IS' ?>">View Student List</a>

                        </li>
                        <hr>
                        <li class="display-flex-row">
                            <p>Computer System Students</p>
                            <a class="common-blue-btn" href="<?php echo URLROOT . 'register/register-student/' . $data['batch_year'] . '/CS' ?>">Add Students</a>
                            <a class="common-blue-btn" href="<?php echo URLROOT . 'pdc/student-list/' . $data['batch_year'] . '/CS' ?>">View Student List</a>
                        </li>
                    </ul>
                    <button class="delete-btn"><a href="<?php echo URLROOT . 'pdc/deleteStudentBatch/' . $data['batch_year']  ?>" class="display-flex-row"> <span class="material-symbols-outlined">
                                delete
                            </span>Delete Batch</a> </button>
                    <!-- <div class="display-flex-col batch_year_rename">
                        <span id="renameBatchyearBtn">Press here to change the Batch Year</span>
                        <form action="" method="POST" class="display-flex-col hide-element" id="rename-student-batch">

                            <input type="number" name="batch_year" id="rename-batch-year-input" required>
                            <input type="submit" name="rename_batch_year" value="Submit">
                            <span id="validate-error-rename"></span>
                        </form>

                    </div> -->
                </div>
            </div>


        </div>

        <!-- CHANGE ACCESS MODAL -->
        <div class="common-modal-box <?php echo $data['change_access_modal_class']; ?>">
            <div class="std-batches-add display-flex-col" id="change-access-modal">
                <a href="<?php echo URLROOT . 'students/manage-student' ?>" id="modal-box-close">
                    <span class="material-symbols-outlined" class="common-modal-close">
                        close
                    </span></a>

                <form action="<?php echo URLROOT . 'students/manageStudentBatch' ?>" id="add-student-batch" class="display-flex-col common-modal-box-form" method="POST">
                    <h3>Change System Access - <?php echo $data['batch_year']; ?> Batch </h3>
                    <div class="display-flex-row">
                        <label for="status">STATUS</label>
                        <select name="access" id="status-dropdown" class="common-input" onchange="this.form.submit()">
                            <option value="" selected disabled></option>
                            <option value="1">Enable access </option>
                            <option value="0">Disable access</option>
                        </select>
                        <input type="hidden" name="batch_year" value="<?php echo $data['batch_year']; ?>">
                    </div>
                </form>
            </div>


        </div>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>