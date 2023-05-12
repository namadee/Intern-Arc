<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
	<?php flashMessage('login_success'); ?>
	<div class="dashboard-topbar display-flex-row">
		<div class="dash-top-left display-flex-row ">
			<span class="material-symbols-outlined">
				campaign
			</span>
			<p id="dashboard-round-date-data">
				1st Round :
			</p>
			<span id="dashboard-round-date" class="display-flex-row">Hello
				
			</span>

		</div>
		<div class="dash-top-right display-flex-row">
			<span class="material-symbols-outlined">
				campaign
			</span>
			<p id="dashboard-round-date-data">2nd Round :</p>
			<span id="dashboard-round-date" class="display-flex-row">
				Hello
			</span>
		</div>

	</div>
	<div class="dashboard-cards display-flex-row">
		<div class="display-flex-row">
			<span></span>
			<p class="dashboard-card-item">Total Registered Companies</p>
			<p class="dashboard-card-total"> </p>
		</div>
		<div class="registered-companies display-flex-row">
			<span></span>
			<p class="dashboard-card-item">Total Registered Students</p>
			<p class="dashboard-card-total"></p>
		</div>
	</div>

	<div class="dashboard-advertisement-list display-flex-col">
	<h2>Current Batch Year</h2>
	</div>

</section>




<?php require APPROOT . '/views/includes/footer.php'; ?>