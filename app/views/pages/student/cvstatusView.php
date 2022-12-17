<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="cv-status-container">

<div class="cv-status-top">
	
	<div class="cv-status-flex-container">

		<div class="cv-status-flex-wrap2">
			<h3>CV Status</h3>
		</div>
		<div class="cv-status-flex-wrap3">
			<div class="cv-status-input-field">
				<p>Attach file:</p>
				<form>
				<input type="file" id="myFile" name="filename">
				<div class="cv-status-myCV">
					<i class="fa fa-file"></i> myCV
				</div>
				<input type="submit" class="cv-status-cv-submit-button" value="Upload">
		  		</form>
			</div>
		</div>
	       
	</div>
</div>

</section>

	
<?php require APPROOT . '/views/includes/footer.php'; ?>