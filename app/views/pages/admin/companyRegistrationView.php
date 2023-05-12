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
        <input type="number" id="admin_company_register_year" class="common-input" placeholder="Enter a year">
        <button id="admin_company_register_btn" class="common-blue-btn"><a id="search-element-company-reg-year" href="">Search</a></button>
        <button id="secondary-grey-btn"><a href="<?php echo URLROOT.'admin/get-company-registrations'; ?>"  class="display-flex-row" id="reset-btn" ><span class="material-symbols-outlined">
              restart_alt
            </span>Reset</a></button>
      </div>
      
      <p class="display-flex-col" id="company_label"><?php echo $data['countLabel'] . ' '; ?> <span id="count-span"><?php echo $data['count']; ?></span></p>
      <p id="invalid-year-error-msg" style="display: none;">* Please enter a valid year</p>
    </div>
    <div class="manage-company-table">
      <table>
        <thead>
          <th>Company Name</th>
          <th>Contact Person</th>
          <th>Contact Email</th>
          <th>Registerd Date</th>
          <th id="action-th"></th>
        </thead>
        <tbody>

          <?php
          $companyList = $data['allCompanies'];

          foreach ($companyList as $company) :

          ?>
            <tr>
              <td><?php echo $company->company_name ?></td>
              <td><?php echo $company->username ?></td>
              <td><?php echo $company->email ?></td>
              <td><?php echo $company->created_at ?></td>
              <td><a href="<?php echo URLROOT . 'profiles/company-profile/' . $company->user_id ?>">View</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <button class="download-report-btn" ><a href="<?php echo $data['downloadBtnHref']; ?>" target="_blank">Download Report</a></button>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>