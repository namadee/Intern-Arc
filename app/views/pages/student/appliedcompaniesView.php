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
	<h3>Applied Advertisements </h3>
<div class="applied-companies-flex-container">
	
	<table class="applied-companies-table">

	
	
		<tr>
		  <th>Company Name</th>
		  <th>Position</th>
		  <th>Status</th>
		</tr>

		<?php foreach ($data['appliedAdvertisements'] as $appliedAdvertisements) : ?>
		<tr>
		<td><?php echo $appliedAdvertisements->company_name ?></td>
        <td><?php echo $appliedAdvertisements->position ?></td>
		<td><button class="applied-companies-statusbtn"><?php echo $appliedAdvertisements->status ?></button></td>
        <td></td>
		</tr>
	<?php endforeach; ?>
		
	  </table>


</div>
</div>


</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>