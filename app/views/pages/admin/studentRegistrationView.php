<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content">
  <?php flashMessage('reportMsg') ?>
  <div id="admin_company_registrations_div" class="display-flex-col">
  <div class="top-container display-flex-row">
      <div class="batchYearSelectDiv display-flex-row">
        <label for="year">Select the batch year</label>
        <select name="year" class="common-input" id="year" onchange="location.href = '<?php echo URLROOT . 'admin/get-student-registrations/' ?>' + this.value;">
          <?php foreach ($data['studentBatches'] as $batch) : ?>
            <option value="<?php echo $batch->batch_year ?>" <?php echo $batch->batch_year == $data['selectedBatchYear'] ? 'selected' : '' ?>><?php echo $batch->batch_year ?></option>
          <?php endforeach; ?>
        </select>
        <button id="secondary-grey-btn"><a href="<?php echo URLROOT . 'admin/get-student-registrations'; ?>" class="display-flex-row" id="reset-btn"><span class="material-symbols-outlined">
              restart_alt
            </span>Reset</a></button>
      </div>
      <p class="display-flex-col" id="company_label">Total Students <span id="count-span"><?php echo $data['count']; ?> Students</span></p>
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

        <?php
          $studentList = $data['studentList'];

          if ($studentList) {
            foreach ($studentList as $student) {
              echo "<tr>
                <td>{$student->username}</td>
                <td>{$student->email}</td>
                <td>{$student->registration_number}</td>
                <td>{$student->index_number}</td>
                <td><a href='" . URLROOT . "profiles/company-profile/{$student->user_id}'>View</a></td>
            </tr>";
            }
          } else {
            echo "<tr> <td>No Students to show </td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <button class="download-report-btn" ><a href="<?php echo $data['downloadBtnHref']; ?>" target="_blank">Download Report</a></button>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>