<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="view-companies-container">

<br/><br/><br/>

<div class="view-companies-top">
	
<div class="view-companies-flex-container">

	<div class="view-companies-flex-wrap">
		<div class="view-companies-heading">
			<h3>Company List</h3>
		</div>
		<div class="view-companies-search">
			<form class="view-companies-search-container">
				<button class="view-companies-search-btn" type="submit"><i class="fa fa-search"></i></button>
				<input type="text" placeholder="Search Company" name="search" id="search">
			</form>
		</div>
	</div>
<div class="view-companies" id="view-companies-table-container">
	<table class="view-companies-table" id="view-companies-table">
		<thead>
		<tr>
		  <th class="view-companies-table-header">Company Name</th>
		  <th class="view-companies-table-header"></th>
		</tr>
</thead>
<tbody>
		
		<?php foreach ($data['listCompanies'] as $listCompanies) : ?>
			<tr>
				<td class="view-companies-table-data"><?php echo $listCompanies->company_name ?></td>
				<td class="view-companies-table-data"><a href="<?php echo URLROOT.'students/company-profile';?>"><button>view</button></a></td>
			</tr>

			

			<?php endforeach; ?>
		
</tbody>
</table>
</div>
	       
</div>
</div>

</section>

<script src='<?php echo URLROOT; ?>js/searchCompanies.js'></script>

<?php require APPROOT . '/views/includes/footer.php'; ?>