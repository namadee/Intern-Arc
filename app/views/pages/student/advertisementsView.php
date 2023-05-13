<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/shared.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>




<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="advertisements-view-container">

<div class="published-ad-list-headingfloat">
	<br/><br/><br/><br/>
	<div class="published-ad-list-flex-wrap">
		<div><h4>Round: 1st round</h4></div>
		<div><h4>Ending date: 2022/09/22</h4></div>
	</div>
</div>


<div class="published-ad-list-top">
	
<div class="published-ad-list-flex-container">

	<div class="published-ad-list-flex-wrap2">
		<div class="published-ad-list-heading">
			<h3>Advertisments</h3>
		</div>



    <div class="dropdown-items">
				<div class="dropdown">
					<button class="dropbtn">Company</button>
					<div class="dropdown-content">
			  		<!-- <a href="#">Link 1</a>
			  		<a href="#">Link 2</a>
			  		<a href="#">Link 3</a> -->
            <?php foreach ($data['listCompanies'] as $listCompanies) : ?>
              
              
				
				<a href="#"><?php echo $listCompanies->company_name ?></a>
			
      <?php endforeach; ?>
					</div>
				</div>

				<div class="dropdown">
					<button class="dropbtn">Position</button>
					<div class="dropdown-content">
			  		<!-- <a href="#">Link 1</a>
			  		<a href="#">Link 2</a>
			  		<a href="#">Link 3</a> -->
					  <?php foreach ($data['jobroleList'] as $jobroleList) : ?>
              
              
				
			  <a href="#"><?php echo $jobroleList->name ?></a>
			  <?php endforeach; ?>
				</div>
			</div>


  
	</div>
  <div class="published-ad-list-container">
			<form id="search-form">
				
				<input type="text" placeholder="Search.." name="search" class="common-search-bar">
			</form>
		</div>
</div>
	<table class="published-ad-list-ad-table">
		<tr>
		  <th>Company Name</th>
		  <th>Advertisement Name</th>
		  <th></th>
		</tr>
		
			<?php foreach ($data['companyData'] as $companyData) : ?>
			<tr>
				<td class="view-ads-table-data"><?php echo $companyData->company_name ?></td>
				<td class="view-ads-table-data"><?php echo $companyData->position ?></td>
  				<td class="view-ads-table-data"><a href="<?php echo URLROOT; ?>advertisements/view-advertisement/<?php echo $companyData->advertisement_id; ?>"><button class="common-view-btn">view</button></td>
			</tr>
			<?php endforeach; ?>
	  </table>
	       



</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>