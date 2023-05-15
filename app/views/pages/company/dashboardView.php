<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col" id="company-dashboard">

  <?php
  $roundTableData = $_SESSION['roundTableData'];
  $value;

  if (($roundDataArray['roundNumber']) == 1) {
    $value = $roundTableData[0]->start_date;
  } else if (($roundDataArray) == 2) {
    $value = $roundTableData[1]->end_date;
  }
  ?>
  <div class="company-top-notif">
    <p>Ending date of current round period: <?php echo $value ?> </p>
  </div>
  <div class="company-dashboard-top">
    <div class="company-dashboard-box">
      <?php
      $applycount = 0;
      $shortlistcount = 0;
      foreach ($data['dashboard'] as $dashboard) :
        $applycount = $applycount + 1;
        if ($dashboard->status == 'shortlisted') {
          $shortlistcount = $shortlistcount + 1;
        }
      endforeach; ?>
      <div>
        <div class="blue-line"> </div>
        <p>Total Students Applied</p>
      </div>
      <p><?php echo $applycount ?></p>
    </div>
    <div class="company-dashboard-box">
      <div>
        <span class="blue-line"></span>
        <p>Total students Shortlisted</p>
      </div>
      <p><?php echo $shortlistcount ?></p>
    </div>
    <div class="company-dashboard-box">
      <div>
        <span class="blue-line"></span>
        <p>Total Advertisements</p>
      </div>
      <p><?php echo $data['total'] ?></p>
    </div>
  </div>

  <div class="common_list_content">

    <table class="common-table">
      <div class="common-list-topbar">
        <h3>Student Requests</h3>
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

      <tr>
        <th>Name</th>
        <th>Student Email</th>
        <th>Degree Program</th>
        <th>Advertisement</th>
        <th>Status</th>

      </tr>

      <?php foreach ($data['dashboard'] as $dashboard) : ?>
        <tr>
          <td><?php echo $dashboard->profile_name ?></p>
          </td>
          <td><?php echo $dashboard->personal_email ?></td>
          <td><?php echo $dashboard->stream ?></td>
          <td><?php echo $dashboard->position ?></td>
          <td>
            <div class="common-status display-flex-row advertisement-status <?php echo $dashboard->status == 'pending' ? 'yellow-status-font' : ($dashboard->status == 'rejected' ? 'red-status-font' : ''); ?> ">

              <span class="common-status-span <?php echo $dashboard->status == 'pending' ? 'yellow-status' : ($dashboard->status == 'rejected' ? 'red-status' : ''); ?>">
              </span>
              <?php echo ucfirst($dashboard->status); ?>
            </div>
          </td>

          <td>
            <a class="common-view-btn" href="<?php echo URLROOT . 'students/student-profile/' . $dashboard->student_id ?>">View</a>
          </td>


        </tr>

      <?php endforeach; ?>

    </table>
    <a href="<?php echo URLROOT; ?>requests/advertisement-list-requests" class="common-blue-btn">View All</a>
  </div>


  </div>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>