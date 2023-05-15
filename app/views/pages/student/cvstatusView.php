<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/student.js" defer></script>

<?php require APPROOT . '/views/includes/navbar.php'; ?>



<section class="main-content display-flex-col">
	<?php flashMessage('cv_status'); ?>

	<div class="cv-status-top">

		<div class="cv-status-flex-container" style="margin: auto;">
			<div style="width: 40%; margin: auto; margin-top: 5%;" class="csv-company-bottom">
				<h3 style="text-align: center;">Upload your CV</h3>
				<p style="color:var(--DangerColor); text-align: center; margin-bottom: 2rem;">Please note that only PDF files are allowed to upload</p>
				<form  action="<?php echo URLROOT . "students/uploadCV"; ?>" name="uploadCv" enctype="multipart/form-data" method="POST" class="display-flex-col" id="csvFormRegistration">
					<label for="myCvFile" class="display-flex-row">
						<span class="material-symbols-outlined">
							drive_folder_upload
						</span>
						<p id="form-file-name">No file Choosen</p>
					</label>
					<input type="file" name="myCvFile" id="myCvFile" accept=".pdf">
					<button type="submit" class="common-blue-btn">Submit CV</button>
				</form>
			</div>
		</div>
	</div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>