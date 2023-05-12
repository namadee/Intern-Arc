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
        <select name="year" class="common-input" id="year" onchange="location.href = '<?php echo URLROOT . 'admin/get-advertisement-reports/' ?>' + this.value;">
          <?php foreach ($data['studentBatches'] as $batch) : ?>
            <option value="<?php echo $batch->batch_year ?>" <?php echo $batch->batch_year == $data['selectedBatchYear'] ? 'selected' : '' ?>><?php echo $batch->batch_year ?></option>
          <?php endforeach; ?>
        </select>
        <button id="secondary-grey-btn"><a href="<?php echo URLROOT . 'admin/get-advertisement-reports'; ?>" class="display-flex-row" id="reset-btn"><span class="material-symbols-outlined">
              restart_alt
            </span>Reset</a></button>
      </div>
      <p class="display-flex-col" id="company_label">Total Advertisements <span id="count-span"><?php echo $data['count']; ?> Ads</span></p>
    </div>
    <div class="manage-company-table">
      <table>
        <thead>
          <th>Ad Position</th>
          <th>Company Name</th>
          <th>Required Interns</th>
          <th>Total Student Requests</th>
          <th id="action-th"></th>
        </thead>
        <tbody>

          <?php
          $advertisemenList = $data['advertisementList'];

          if ($advertisemenList) {
            foreach ($advertisemenList as $ad) {
              echo "<tr>
                <td>{$ad->position}</td>
                <td>{$ad->company_name}</td>
                <td>{$ad->intern_count}</td>
                <td>{$ad->total_requests}</td>
                <td><a href='" . URLROOT . "advertisements/view-advertisement/{$ad->advertisement_id}'>View</a></td>
            </tr>";
            }
          } else {
            echo "<tr> <td>No advertisements to show </td></tr>";
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
  <button class="download-report-btn"><a href="<?php echo $data['downloadBtnHref']; ?>" target="_blank">Download Report</a></button>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>