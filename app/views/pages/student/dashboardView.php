<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
	sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="dashboard-container main-content">

	<div class="student-details-container">

		<div class="display-flex-col">
			<h1>Dashboard</h2>
				<br />
				<div class="dash-top-right display-flex-row">
					<span class="material-symbols-outlined">
						campaign
					</span>
					<p id="dashboard-round-date-data"> Round : <?php echo $roundDataArray['roundNumber'] ?></p>
					<span id="dashboard-round-date" class="display-flex-row">
						2023-05-25 to 2023-05-25
					</span>
				</div>
				<br />
				<div class="student-details-left">
					<?php foreach ($data['studentDetails'] as $studentDetails) : ?>
						Status : <button class="dashboard-statusbtn"><?php echo $studentDetails->recruit_status ?></button>
						<br /><br />
						Registration Number : <?php echo $studentDetails->registration_number ?>
						<br /><br />
						Email : <?php echo $studentDetails->email ?>
						<br /><br />
						Round : <?php echo $studentDetails->round ?>

					<?php endforeach; ?>
				</div>
		</div>

		<div class="student-details-right display-flex-col">

			<img src="<?php echo $_SESSION['profile_pic'] ?>">
			<a class="common-blue-btn">View Profile</a>
		</div>
	</div>

	<div class="display-flex-col">
		<div class="student-dashboard-bottom display-flex-row">
			<div class="company-dashboard-box">
				<div>
					<span class="blue-line"></span>
					<p>Applied Companies </p>
				</div>
				<p>10</p>
			</div>
			<div class="company-dashboard-box">
				<div>
					<span class="blue-line"></span>
					<p>Total Requests</p>
				</div>
				<p><?php echo $data['reqCount'] ?></p>
			</div>
		</div>
		<div class="company-dash-bottom-box company-dashboard-box">
			<div>
				<span class="blue-line"></span>
				<p>Scheduled Interviews</p>
			</div>
			<p>5</p>
		</div>
	</div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>