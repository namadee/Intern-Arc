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
			<div class="common-filter">
				<span class="material-symbols-rounded">
					filter_alt
				</span>
				<select name="filter-list" id="filterlist">
					<option value="all" selected>All</option>
					<option value="name">name</option>
					<option value="name">name</option>
					<option value="name">name</option>
				</select>
			</div>
		</div>
		<div class="common_list_content">
			<h3>Advertisement List</h3>
			<table class="common-table">
				<tr>
					<th>Advertisement Name</th>
					<th>Company Name</th>
					<th>Status</th>
					<th>View</th>

				</tr>

				<?php foreach ($data['companyData'] as $companyData) : ?>
					<tr>
						<td class="view-ads-table-data"><?php echo $companyData->position ?></td>
						<td class="view-ads-table-data"><?php echo $companyData->company_name ?></td>
						<td class="view-ads-table-data">
							<div class="common-status display-flex-row advertisement-status <?php echo $companyData->status == 'pending' ? 'yellow-status-font' : ($companyData->status == 'rejected' ? 'red-status-font' : ''); ?> ">

								<span class="common-status-span <?php echo $companyData->status == 'pending' ? 'yellow-status' : ($companyData->status == 'rejected' ? 'red-status' : ''); ?>">
								</span>
								<?php echo $companyData->status ?>

							</div>

						</td>
						<td class="view-ads-table-data">
							<a href="<?php echo URLROOT; ?>advertisements/view-advertisement/<?php echo $companyData->advertisement_id; ?>"><button class="common-view-btn">view</button>
						</td>
					</tr>
				<?php endforeach; ?>

			</table>

			<div id="my-div" class="common-modal-box">
				<div class="std-batches-add display-flex-col">


					<form action="" id="add-student-batch" class="display-flex-col common-modal-box-form" method="POST">
						<a href="" id="modal-box-close">
							<span class="material-symbols-outlined" class="common-modal-close">
								close
							</span></a>
						<h3>Select Three Job Roles</h3>
						<br>
						<div class="display-flex-col">
							<?php foreach ($data['jobroleList'] as $jobroleList) : ?>
								<div>
									<input type="checkbox" name="<?php echo $jobroleList->name ?>" value="<?php echo $jobroleList->name ?>">
									<label for="jobrole"><?php echo $jobroleList->name ?></label>
								</div>
							<?php endforeach; ?>
						</div>
						<button type="submit" name="add_form_submit" class="common-blue-btn" id="modal-submit-btn" onclick='return validateForm();'>Add</button>
					</form>
					<span id="validate-error"></span>
				</div>


			</div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>