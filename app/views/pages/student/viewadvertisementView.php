<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="view-advertisement-container">

<div class="view-ad-top">
<div class="view-ad-flex-container">
	<div class="view-ad-flex-wrap2">
		<div>
			<h3>CodeGen International - Quality Assurance</h3>
		</div>
	</div>     
</div>

<div class="view-ad-basic-details-row">
	<table class="basic-details">
		<tr>
			<td>Company Name</td>
			<td class="ad-data">CodeGen International</td>
		</tr>
		<tr>
			<td>job Position</td>
			<td class="ad-data">Quality Assurance</td>
		</tr>
		<tr>
			<td>Mode of Work</td>
			<td class="ad-data">Remote Work</td>
		</tr>
	</table>

	<table class="basic-details">
		<tr>
			<td>Internship Period</td>
			<td class="ad-data">01/09/2022</td> 
			<td class="ad-data">01/03/2023</td> 
		</tr>
	</table>
</div>

<div class="view-ad-descriptions">
	<div class="view-ad-section">
		<h3>Requirements</h3>
		<div class="view-ad-requirements">
			<ul>
				<li>Provide onsite and remote IT support to the local office</li>
				<li>Basic computer, printer, and network troubleshooting
				</li>
				<li>Work with regional team for IT stuffs
				</li>
				<li>Prepare laptops for staffs, ensure all platforms/software used by the company are installed
				</li>
				<li>Collect laptops and reset upon staffs resignations</li>
				<li>Manage user accounts for staffs
				</li>
				<li>Contact vendor/manufacturer to fix hardware problems</li>
				<li>Manage IT infrastructure and assets of the local office
				</li>
				<li>Onboarding local new employees across multiple systems and platforms</li>
			</ul>
		</div>
	</div>

	<div class="view-ad-section">
		<h3>Qualifications</h3>
		<div class="view-ad-requirements">
			<ul>
				<li>Provide onsite and remote IT support to the local office
				</li>
				<li>Basic computer, printer, and network troubleshooting</li>
				<li>Work with regional team for IT stuffs
				</li>
				<li>Prepare laptops for staffs, ensure all platforms/software used by the company are installed
				</li>
				<li>Collect laptops and reset upon staffs resignations
				</li>
				<li>Manage user accounts for staffs
				</li>
				<li>Contact vendor/manufacturer to fix hardware problems</li>
				<li>Manage IT infrastructure and assets of the local office</li>
				<li>Onboarding local new employees across multiple systems and platforms</li>
			</ul>
		</div>
	</div>
</div>
<form class="apply-ad">
<input type="submit" class="view-ad-apply-button" value="Click here to apply">
</form>

</div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>