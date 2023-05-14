<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content">
  <?php flashMessage('recruit_student_msg') ?>
  <div class="common_list">
    <div class="common-list-topbar">
      <form action="" class="common-search-bar display-flex-row">
        <span class="material-symbols-rounded">
          search
        </span>
        <input class="common-input" type="text" name="search-item" placeholder="Search Student">
      </form>
      <div class="common-filter">
        <span class="material-symbols-rounded">
          filter_alt
        </span>
        <select name="filter-list" id="filterlist">
          <option value="all" selected>All</option>
          <option value="name">name</option>
          <option value="name">name</option>
          <option value="name">name</option>
        </select>
      </div>
    </div>

    <div class="common_list_content">

      <div class="addBtn">
        <h3>Software Engineer - Shortlisted Students</h3>
      </div>
      <table class="common-table">
        <tr>
          <th>Student Name</th>
          <th>Student Email</th>
          <th>View</th>
          <th>Status</th>
        </tr>

        <?php foreach ($data['student_name'] as $students) : ?>
          <tr>
            <td><?php echo $students->profile_name ?></p>
            </td>
            <td><?php echo $students->personal_email ?></td>
            <td>
              <a class="common-view-btn" href="<?php echo URLROOT . 'requests/show-requests-by-ad/' . $data['advertisement_id']; ?>">View</a>
            </td>
            <td>

              <div class="common-status display-flex-row <?php echo $students->recruit_status == 'pending' ? 'yellow-status-font' : ($students->recruit_status == 'rejected' ? 'red-status-font' : ''); ?> ">

                <span class="common-status-span <?php echo $students->recruit_status == 'pending' ? 'yellow-status' : ($students->recruit_status == 'rejected' ? 'red-status' : ''); ?>">
                </span>
                <?php

                echo ucfirst($students->recruit_status); ?>
              </div>
            </td>

            <td>
              <form action="<?php echo URLROOT . 'companies/recruit-student/' . $data['advertisement_id'] ?>" id="recruit_student" method="POST">
                <select name="recruit_status" id="status-dropdown" class="common-input" onchange="this.form.submit()">
                  <!-- Add new status column -->
                  <option value="" selected disabled></option>
                  <option value="recruited">Recruit</option>
                  <option value="rejected">Reject</option>
                </select>
                <input type="hidden" name="request_id" value="<?php echo $students->student_request_id; ?>">
                <input type="hidden" name="advertisement_id" value="<?php echo $students->advertisement_id; ?>">
                <input type="hidden" name="student_id" value="<?php echo $students->student_id; ?>">
              </form>
            </td>

          </tr>

        <?php endforeach; ?>

      </table>
    </div>

  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>