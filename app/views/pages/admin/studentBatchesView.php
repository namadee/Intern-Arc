<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
	<?php flashMessage('student_batch_msg'); ?>
	<div class="student-batches-container display-flex-col">
		<div class="student-batches-top display-flex-row">
			<div class="display-flex-row">
				<h2>Student Batches</h2>
				<p class="display-flex-row" id="student-batch-current-year">
					<span id="student-batch-year-span" class="material-symbols-outlined">
						where_to_vote
					</span>
					Current Batch Year is <span id="current-batchyear-session-span"><?php echo $_SESSION['batchYear'] ?></span>

				</p>
			</div>
		</div>
		<div class="student-batches-table">
			<table>
				<thead>
					<tr>
						<th>Batch Year</th>
						<th>CS Count</th>
						<th>IS Count</th>

						<th class="student-batch-status">
							<div class="display-flex-row">
								System Access
								<span class="material-symbols-outlined tooltip">
									error
									<p id="admin-std-batch-tooltip" class="tooltiptext">Determine whether the students can logged <br> in to the system or not</p>
								</span>
							</div>
						</th>


					</tr>
				</thead>
				<tbody>

					<?php foreach ($data['batch_list'] as $batch) : ?>
						<tr>
							<td><?php echo $batch->batch_year  ?> Batch</td>
							<td><?php echo $batch->cs_count  ?> students</td>
							<td><?php echo $batch->is_count  ?> students</td>

							<td>
								<div class="common-status display-flex-row <?php echo $batch->access === '1' ? '' : 'red-status-font'; ?>">

									<span class="common-status-span <?php echo $batch->access === '1' ? '' : 'red-status'; ?>">
									</span>
									<?php echo ($batch->access == "1") ? "Access enabled" : "Access disabled"; ?>
								</div>
							</td>
							<td> <a href="<?php echo URLROOT . 'admin/student/view-batch/' . $batch->batch_year ?>" class="student-batches-btn">View</a></button></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<!-- VIEW BATCH MODAL -->
<div class="common-modal-box <?php echo $data['view-modal-class']; ?>">
	<div class="std-batches-add display-flex-col" id="view-batch-modal">
		<a href="<?php echo URLROOT . 'admin/student' ?>" id="modal-box-close">
			<span class="material-symbols-outlined" class="common-modal-close">
				close
			</span></a>

		<div class="display-flex-col view-batch-div">
			<h2><?php echo $data['batch_year']; ?> Batch</h2>
			<hr>
			<ul class="display-flex-col">
				<li class="display-flex-row">
					<p>Information System Students</p>
					<a class="common-blue-btn" href="<?php echo URLROOT . 'admin/student-list/' . $data['batch_year'] . '/IS' ?>">View Student List</a>

				</li>
				<hr>
				<li class="display-flex-row">
					<p>Computer System Students</p>
					<a class="common-blue-btn" href="<?php echo URLROOT . 'admin/student-list/' . $data['batch_year'] . '/CS' ?>">View Student List</a>
				</li>
			</ul>
		</div>
	</div>


</div>
<?php require APPROOT . '/views/includes/footer.php'; ?>