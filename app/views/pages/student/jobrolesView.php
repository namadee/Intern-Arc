<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="jobroles-view-container">

<div class="job-roles-top">
	
	<div class="job-roles-flex-container">

		<div class="job-roles-flex-wrap2">
			<h3>You must select 3 job roles</h3>
		</div>
		<div class="job-roles-flex-wrap3">
			<form class="job-roles-select">
			<table class="job-roles-select-data">
				<th class="job-role-table-header-name">Job Role</th>
				<th class="job-role-table-header-select">Select</th>
				<tr>
					<td class="job-role-table-name"><label for="jobrole1"> Software Engineer</label></td>
					<td class="job-role-table-submit"><input type="checkbox" id="jobrole1" name="jobrole1" value="SE"></td>
				</tr>

				<tr>
					<td class="job-role-table-name"><label for="jobrole2">Quality Assurance</label></td>
					<td class="job-role-table-submit"><input type="checkbox" id="jobrole2" name="jobrole2" value="QA"></td>
				</tr>

				<tr>
					<td class="job-role-table-name"><label for="jobrole3">Business Analyst</label></td>
					<td class="job-role-table-submit"><input type="checkbox" id="jobrole3" name="jobrole3" value="BA"></td>
				</tr>

				<tr>
					<td class="job-role-table-name"><label for="jobrole4">UI/UX Engineer</label></td>
					<td class="job-role-table-submit"><input type="checkbox" id="jobrole4" name="jobrole4" value="UIUX"></td>
				</tr>

				<tr>
					<td class="job-role-table-name"><label for="jobrole5">Mobile Application Developer</label></td>
					<td class="job-role-table-submit"><input type="checkbox" id="jobrole5" name="jobrole5" value="MAD"></td>
				</tr>

				<tr>
					<td class="job-role-table-name"><label for="jobrole6">DevOps Engineer</label></td>
					<td class="job-role-table-submit"><input type="checkbox" id="jobrole6" name="jobrole6" value="DevOps"></td>
				</tr>
			</table>

			<input class="job-role-submit-button" type="submit" value="Submit">

			</form>
		</div>
	       
	</div>
</div>

</section>

	
<?php require APPROOT . '/views/includes/footer.php'; ?>