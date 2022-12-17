<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="dashboard-container">

<br/><br/>
<div class="dashboard-top">
	<h3>My Dashboard</h3>
<div class="dashboard-flex-container">
	<div class="dashboard-textarea">
		Status : <button class="dashboard-statusbtn">Pending</button>
		<br/><br/>
		Registration Number : 2020/IS/003
		<br/><br/>
		Email : Ruchirabogahawatta@gmail.com
		<br/><br/>
		Round : 1st round 
	</div>
	<div class="dashboard-btnarea"><form><button class="dashboard-profile-view-btn">View my profile</button></div></form>
</div>
</div>
<br/>
<div class="dashboard-bottom-strip">
	<div class="bottom-strip-blue-line"><p>1</p></div>
	<div class="bottom-strip-description"><p>Applied Companies</p></div>
	<div class="bottom-strip-number"><p>5</p></div>
	<div class="bottom-strip-button">View</div>
</div>
<br/>
<div class="dashboard-bottom-strip">
	<div class="bottom-strip-blue-line"><p>1</p></div>
	<div class="bottom-strip-description"><p>Schedule Interview</p></div>
	<div class="bottom-strip-number"><p>5</p></div>
	<div class="bottom-strip-button">View</div>
</div>

</section>

	
<?php require APPROOT . '/views/includes/footer.php'; ?>