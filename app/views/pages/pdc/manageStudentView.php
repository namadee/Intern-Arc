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
                               System Access <span class="material-symbols-outlined">
                                    help
                                </span>
                            </div>
                        </th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($data['batch_list'] as $batch) : ?>
                        <tr>
                            <td><?php echo $batch->batch_year  ?> Batch</td>
                            <td>0</td>
                            <td>0</td>

                            <td>
                                <div class="common-status display-flex-row <?php echo $batch->access === 'active' ? '' : 'red-status-font'; ?>">

                                    <span class="common-status-span <?php echo $batch->access === 'active' ? '' : 'red-status'; ?>">
                                    </span>
                                    <?php echo ucfirst($batch->access); ?>
                                </div>
                            </td>
                            <td> <a href="<?php echo URLROOT . 'students/manage-student/view-batch/' . $batch->batch_year ?>" class="student-batches-btn">View</a></button></td>
                            <td>
                                <button> <a href="<?php echo URLROOT . 'students/manage-student/change-access/' .  $batch->batch_year ?>">Change Access</a></button>
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
                            <a class="common-blue-btn" href="<?php echo URLROOT . 'pdc/student-list/' . $data['batch_year'] . '/IS' ?>" >View Student List</a>

                        </li>
                        <hr>
                        <li class="display-flex-row">
                            <p>Computer System Students</p>
                            <a class="common-blue-btn" href="<?php echo URLROOT . 'register/register-student/' . $data['batch_year'] . '/CS' ?>">Add Students</a>
                            <a class="common-blue-btn" href="<?php echo URLROOT . 'pdc/student-list/' . $data['batch_year'] . '/CS' ?>">View Student List</a>
                        </li>
                    </ul>
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
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <input type="hidden" name="batch_year" value="<?php echo $data['batch_year']; ?>">
                    </div>
                </form>
            </div>


        </div>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>