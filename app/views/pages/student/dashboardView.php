<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
	sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="dashboard-container">
	<?php flashMessage('recrtuited_noAccess');
	?>
	<br /><br />
	<div class="dashboard-top">
		<h3>My Dashboard</h3>
		<div class="dashboard-flex-container">
			<div class="dashboard-textarea">

				<?php foreach ($data['studentDetails'] as $studentDetails) : ?>
					Status : <button class="dashboard-statusbtn"><?php echo $studentDetails->recruit_status ?></button>
					<br /><br />
					Registration Number : <?php echo $studentDetails->registration_number ?>
					<br /><br />
					Email : <?php echo $studentDetails->email ?>
					<br /><br />
					Round : <?php echo $studentDetails->round ?>
			</div>
		<?php endforeach; ?>


		<div class="dashboard-btnarea">
			<a href="<?php echo URLROOT . 'profiles/student-profile'; ?>">
				<button class="dashboard-profile-view-btn">View my profile</button></a>
		</div>
		</div>
	</div>
	<br />
	<p>

	</p>
	<div class="dashboard-bottom-strip">
		<div class="bottom-strip-blue-line">
			<p>1</p>
		</div>
		<div class="bottom-strip-description">
			<p>Applied Companies</p>
		</div>
		<div class="bottom-strip-number">
			<p><?php echo $data['reqCount'] ?> </p>
		</div>
		<div class="bottom-strip-button"><a href="<?php echo URLROOT . 'students/view-applied-company-list'; ?>"> View </a> </div>
	</div>
	<br />
	<div class="dashboard-bottom-strip">
		<div class="bottom-strip-blue-line">
			<p>1</p>
		</div>
		<div class="bottom-strip-description">
			<p>Schedule Interview</p>
		</div>
		<div class="bottom-strip-number">
			<p>5</p>
		</div>
		<div class="bottom-strip-button"><a href="<?php echo URLROOT . 'schedule'; ?>">View</a> </div>
	</div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>