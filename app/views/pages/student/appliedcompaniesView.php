<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="applied-companies-container">

<br/><br/>
<div class="applied-companies-top">
	<h3>Applied Companies</h3>
<div class="applied-companies-flex-container">
	
	<table class="applied-companies-table">
		<tr>
		  <th>Company Name</th>
		  <th>Position</th>
		  <th>Status</th>
		</tr>

		<tr>
		  <td>Vitusa</td>
		  <td>Software Engineer</td>
		  <td><button class="applied-companies-statusbtn">Shortlisted</button></td>
		</tr>

		<tr>
			<td>WSO2</td>
			<td>Quality Assurance</td>
			<td><button class="applied-companies-statusbtn">Pending</button></td>
		</tr>

		<tr>
			<td>Codegen International</td>
			<td>Business Analyst</td>
			<td><button class="applied-companies-statusbtn">Rejected</button></td>
		</tr>

		<tr>
			<td>Sysco Labs</td>
			<td>UI/UX Engineer</td>
			<td><button class="applied-companies-statusbtn">Pending</button></td>
		</tr>

		<tr>
			<td>Tech Venturas</td>
			<td>DevOps Engineer</td>
			<td><button class="applied-companies-statusbtn">Recruited</button></td>
		</tr>
		
	  </table>


</div>
</div>


</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>