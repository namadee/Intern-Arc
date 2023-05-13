<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="pdc_jobroles_page" class="main-content">
  <?php flashMessage('reportMsg') ?>

  <div class="jobroles-quickAdd display-flex-col adminReportsListDiv">
    <h3>
      Reports
    </h3>
    <div class="report-item">
      <a href="<?php echo URLROOT . 'admin/get-company-registrations'; ?>" class=" display-flex-row">Company Registration Reports <span class="material-symbols-outlined">
          chevron_right
        </span></a>
    </div>
    <div class="report-item">
      <a href="<?php echo URLROOT . 'admin/get-student-registrations'; ?>" class="display-flex-row">Student Registration Reports<span class="material-symbols-outlined">
          chevron_right
        </span></a>
    </div>
    <div class="report-item">
      <a href="<?php echo URLROOT . 'admin/get-advertisement-reports'; ?>" class="display-flex-row"> Advertisement Reports<span class="material-symbols-outlined">
          chevron_right
        </span></a>
    </div>
    <div class="report-item">
      <a href="<?php echo URLROOT . 'admin/get-round-reports'; ?>" class="display-flex-row"> Round Reports<span class="material-symbols-outlined">
          chevron_right
        </span></a>
    </div>
  </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>