<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="schedule-advertisement-container">

<br/><br/>
<div class="schedule-ad-top">

<div class="schedule-ad-flex-container">
	<h3> Company Name: Virtusa </h3>
	<h3> Job Position: Software Engineer </h3> <br/>
	<h3>Iinternship interview Schedule</h3>
    <br/>
	<form class="schedule-ad-form">
	<ul>
		<li style="color: blue ;">02/02/2022 - Monday - 09.30 to 12.00</li>
			<ul>
				<li>09.30 a.m. to 10.00 a.m. &nbsp;<input type="radio"></li>
				<li>10.00 a.m. to 10.30 a.m. &nbsp;<input type="radio"></li>
				<li>10.30 a.m. to 11.00 a.m. &nbsp;<input type="radio"></li>
				<li>11.00 a.m. to 11.30 a.m. &nbsp;<input type="radio"></li>
				<li>12.30 a.m. to 12.00 p.m. &nbsp;<input type="radio"></li>
			</ul>
		<li style="color: blue ;">02/02/2022 - Tuesday - 01.00 to 03.00</li>
		<li style="color: blue ;">02/02/2022 - Wednesday -09.30 to 12.00</li>
	</ul> <br/><br/>

	<button class="dashboard-profile-view-btn">Schedule</button></a></div>

</form>
</div>
</div>

</section>

	
<?php require APPROOT . '/views/includes/footer.php'; ?>