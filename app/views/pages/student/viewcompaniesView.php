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
				<input type="text" placeholder="Search Company" name="search">
			</form>
		</div>
	</div>

	<table class="view-companies-table" >
		<tr>
		  <th class="view-companies-table-header">Company Name</th>
		  <th class="view-companies-table-header"></th>
		</tr>

		<tr>
		  <td class="view-companies-table-data">Virtusa</td>
		  
		  <td class="view-companies-table-data"><a href="<?php echo URLROOT.'students/company-profile';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td class="view-companies-table-data">WSO2</td>
			<td class="view-companies-table-data"><a href="<?php echo URLROOT.'students/company-profile';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td class="view-companies-table-data">Codegen International</td>
			<td class="view-companies-table-data"><a href="<?php echo URLROOT.'students/company-profile';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td class="view-companies-table-data">Sysco Labs</td>
			<td class="view-companies-table-data"><a href="<?php echo URLROOT.'students/company-profile';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td class="view-companies-table-data">Tech Venturas</td>			
			<td class="view-companies-table-data"><a href="<?php echo URLROOT.'students/company-profile';?>"><button>view</button></a></td>
		</tr>
	  </table>
	       
</div>
</div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>