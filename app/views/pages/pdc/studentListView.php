<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
<?php flashMessage('student_list_msg') ?>


    <div class="student-list-container company-content-container display-flex-col">
        <div class="company-content-top display-flex-row">
            <h2><span id="pdc-student-list-stream"><?php echo $data['stream'] === 'IS' ? 'Information Systems' : 'Computer Systems'; ?></span>  Student List - <span id="pdc-student-list-batch-year"> <?php echo $data['batch_year']; ?> </span> Batch</h2>
            <!-- Common Search Bar Style-->
            <form action="javascript:void(0)" class="common-search-bar display-flex-col">
                <div class="display-flex-row">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                    <input class="common-input" type="text" name="search-item" id="pdc_search_student" placeholder="Search Index Number">
                </div>
                <div class="common-search-result display-flex-col" id="pdc_student_result"> </div>
            </form>
        </div>
        <div class="manage-company-table">
            <table>
                <thead>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <th>Registration Number</th>
                    <th>Index Number</th>
                    <th id="action-th"></th>

                </thead>
                <tbody>
                    <?php foreach ($data['student_list'] as $student): ?>
                        <tr>
                            <td><?php echo $student->username  ?></td>
                            <td><?php echo $student->email  ?></td>
                            <td><?php echo $student->registration_number  ?></td>
                            <td><?php echo $student->index_number  ?></td>
                            <td><a href="<?php echo URLROOT . 'profiles/view-student-profile/'. $student->user_id; ?>">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="add-new-students display-flex-row">
            <a class="common-blue-btn" href="<?php echo URLROOT . 'register/register-student/'.$data['batch_year'] . '/'.$data['stream'] ; ?>">Register New Students</a>
        </div>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>