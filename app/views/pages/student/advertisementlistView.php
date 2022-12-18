<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="advertisement-list-container">

<br/><br/>
<div class="ad-list-top">

<div class="ad-list-flex-container">
	<table class="ad-list-table">
		<tr>
		  <th>Advertisment Name</th>
		  <th>Status</th>
		  <th></th>
		</tr>

		<tr>
		  <td>Wed Development</td>
		  <td>Scheduled</td>
		  <td><button>view</button></td>
		</tr>

		<tr>
			<td>Wed Development</td>
			<td>Not Scheduled</td>
			<td><button>view</button></td>
		</tr>

		<tr>
			<td>DevOps Engineer</td>
			<td>Scheduled</td>
			<td><button>view</button></td>
		</tr>

		<tr>
			<td>UI/UX Engineer</td>
			<td>Scheduled</td>
			<td><button>view</button></td>
		</tr>
		
	  </table>


</div>
</div>

</section>

	
<?php require APPROOT . '/views/includes/footer.php'; ?>