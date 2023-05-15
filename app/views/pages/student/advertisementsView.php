<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/shared.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>




<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
	sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section id="advertisement-list" class="main-content">


	<div class="common_list">
		<div class="common-list-topbar">
			<form action="" class="common-search-bar display-flex-row">
				<span class="material-symbols-rounded">
					search
				</span>
				<input class="common-input" type="text" name="search-item" placeholder="Search Advertisement">
			</form>

		</div>
		<div class="common_list_content">
			<h3>Advertisement List</h3>
			<table class="common-table">
				<tr>
					<th>Advertisement Name</th>
					<th>Company Name</th>
					<th>View</th>

				</tr>

				<?php 
				
					if ($data['status'] == 0) {
						echo "<tr><td colspan='3' style='text-align:center;'>No advertisements available since round is not started</td></tr>";
					}else{
						foreach ($data['advertisemetList'] as $advertisement) :
					
							
				?>			

				
					<tr>
						<td class="view-ads-table-data"><?php echo $advertisement->position ?></td>
						<td class="view-ads-table-data"><?php echo $advertisement->company_name ?></td>
						<td class="view-ads-table-data">
							<a href="<?php echo URLROOT; ?>advertisements/view-advertisement/<?php echo $advertisement->advertisement_id; ?>"><button class="common-view-btn">view</button>
						</td>
					</tr>
				<?php endforeach; }?>

			</table>



</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>