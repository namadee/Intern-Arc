<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<script src="<?php echo URLROOT; ?>js/student.js" defer></script>

<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
	sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="dashboard-container">
	<?php flashMessage('recrtuited_noAccess');
	 flashMessage('job_role_msg');
	 
	?>

	<br /><br />
	<div class="dashboard-top" style="width: 80%;">
		<h3>My Dashboard</h3>
		<div class="dashboard-flex-container">
			<div class="dashboard-textarea" style=" width: 50%;">

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
								
								<button><a href="<?php echo  URLROOT.'students/view-applied-company-list'; ?>">View Applied Companies</a></button>
							<?php endforeach; ?>
						</div>
				</div>


			</div>

			<div class="display-flex-col">
				<div class="student-details-right display-flex-col">

					<img style="
    width: 10rem;
    height: 10rem;
    object-fit: cover;
" src="<?php echo $_SESSION['profile_pic'] ?>">
					<a href="<?php echo URLROOT.'profiles/student-profile';  ?>" class="common-blue-btn">View Profile</a>
				</div>
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
			<div id="my-div" class="common-modal-box <?php echo $data['jobroleSelectModalClass']; ?>" >
				<div class="std-batches-add display-flex-col">


					<form action="<?php echo  URLROOT.'students/setStudentJobRole'; ?>" id="job-role-select-form" class="display-flex-col common-modal-box-form" method="POST">
							<h3 style="text-align: center;" >Round 2 Started!</h3>
						<h3 style="text-align: center;" >Select Three Job Roles</h3>
						<br>
						<div class="display-flex-col">
							<?php foreach ($data['jobroleList'] as $jobroleList) : ?>
								<div>
									<input type="checkbox" name="jobRoleID[]" value="<?php echo $jobroleList->jobrole_id ?>">
									<label for="jobrole"><?php echo $jobroleList->name ?></label>
								</div>
							<?php endforeach; ?>
						</div>
						<button type="submit" class="common-blue-btn" id="modal-submit-btn">Add</button>
					</form>
					<span id="validate-error"></span>
				</div>


			</div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>