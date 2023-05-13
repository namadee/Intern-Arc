<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col admin-dashboard">
	<?php flashMessage('login_success'); ?>
	<div class="dashboard-topbar display-flex-row">
		<div class="display-flex-col">
			<div class="dash-top-left display-flex-row ">
				<span class="material-symbols-outlined">
					campaign
				</span>
				<?php
				$roundPeriod = $data['roundDetails'];

				if ($roundPeriod[0]->start_date == NULL || $roundPeriod[0]->end_date == NULL || $roundPeriod[1]->start_date == NULL || $roundPeriod[1]->end_date == NULL) {
					$roundPeriodOneData = 'Not set yet';
					$roundPeriodTwoData = 'Not set yet';
					$roundOneLoadingIcon = '';
					$roundTwoLoadingIcon = '';
				} else {

					//For loading icon
					if ($roundDataArray['roundNumber'] == 1) {
						$roundOneLoadingIcon = '<span class="material-symbols-outlined" id="loading-material-icon"> autorenew </span>';
						$roundTwoLoadingIcon = '';
					} else if ($roundDataArray['roundNumber'] == 2) {
						$roundOneLoadingIcon = '';
						$roundTwoLoadingIcon = '<span class="material-symbols-outlined" id="loading-material-icon"> autorenew </span>';
					} else {
						$roundOneLoadingIcon = '';
						$roundTwoLoadingIcon = '';
					}
					foreach ($roundPeriod as $period) {
						if ($period->round_no == 1) {
							$roundPeriodOneData = $period->start_date . ' to ' . $period->end_date;
						} else {
							$roundPeriodTwoData = $period->start_date . ' to ' . $period->end_date;
						}
					}
				}

				?>
				<p id="dashboard-round-date-data">
					1st Round :
				</p>
				<span id="dashboard-round-date" class="display-flex-row"><?php echo $roundPeriodOneData ?>
					<?php echo $roundOneLoadingIcon ?>
				</span>

			</div>
			<div class="dash-top-right display-flex-row">
				<span class="material-symbols-outlined">
					campaign
				</span>
				<p id="dashboard-round-date-data">2nd Round :</p>
				<span id="dashboard-round-date" class="display-flex-row"><?php echo $roundPeriodTwoData ?>
					<?php echo $roundTwoLoadingIcon ?>
				</span>
			</div>
		</div>
		<p class="display-flex-row" id="student-batch-current-year">
			<span id="student-batch-year-span" class="material-symbols-outlined">
				where_to_vote
			</span>
			Current Batch Year is <span id="current_batchyear_advertisement_span_admin"><?php echo $_SESSION['batchYear'] ?></span>

		</p>
	</div>
	<div class="dashboard-cards display-flex-row">
		<div class="display-flex-row">
			<span> </span>
			<p class="dashboard-card-item">Total Registered Companies</p>
			<p class="dashboard-card-total"> <?php echo $data['companyCount']; ?></p>
		</div>
		<div class="registered-companies display-flex-row">
			<span></span>
			<p class="dashboard-card-item">Total Registered Students</p>
			<p class="dashboard-card-total"><?php echo $data['studentCount']; ?></p>
		</div>
	</div>

	<?php
	// Data for the chart

	$jobPositionData = $data['jobPositionData'];
	$companyData = $data['companyData'];

	if ($jobPositionData) {
		foreach ($jobPositionData as $job) {
			$jobPositions[] = $job->position;
			$applicationCount[] = $job->applications;
		}
	} else {
		$jobPositions[0] = "No data to display";
		$applicationCount[0] = 0;
	}


	if ($companyData) {
		foreach ($companyData as $company) {
			$companyNames[] = $company->company_name;
			$appliedCount[] = $company->applications;
		}
	} else {
		$companyNames[0] = "No data to display";
		$appliedCount[0] = 0;
	}


	?>
	<div class="display-flex-row admin-dashboard-selectYear">
		<label for="year">Select a year: </label>
		<select name="year" class="common-input" id="year" onchange="location.href = '<?php echo URLROOT . 'admin/index/' ?>' + this.value;">
			<?php foreach ($data['studentBatches'] as $batch) : ?>

				<option <?php echo ($batch->batch_year == $data['batchYear']) ? "selected" : "" ?> value="<?php echo $batch->batch_year ?>"><?php echo $batch->batch_year ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="dashboard-advertisement-list display-flex-row admin-dashboard-bottom-div">
		<div class="display-flex-col dash-bottom">
			<div class="display-flex-row">
				<p> Top 5 job positions applied for by Students</p>
			</div>
			<div>
				<canvas id="myChart"></canvas>
			</div>
		</div>
		<div class="display-flex-col dash-bottom">
			<div class="display-flex-row">
				<p> Top Companies applied by Students</p>
			</div>
			<div>
				<canvas id="myChart2"></canvas>
			</div>
		</div>

	</div>

</section>

<script>
	const ctx = document.getElementById('myChart');
	const ctx2 = document.getElementById('myChart2');
	const jobPositions = <?php echo json_encode($jobPositions); ?>;
	const applicationCount = <?php echo json_encode($applicationCount); ?>;

	const companyNames = <?php echo json_encode($companyNames); ?>;
	const appliedCount = <?php echo json_encode($appliedCount); ?>;


	new Chart(ctx, {
		type: 'pie',
		data: {
			labels: jobPositions,
			datasets: [{
				label: '# Applied Count',
				data: applicationCount,
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: false,
					display: false
				},

			}
		}
	});

	new Chart(ctx2, {
		type: 'pie',
		data: {
			labels: companyNames,
			datasets: [{
				label: '# Applied Count',
				data: appliedCount,
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: false,
					display: false
				},

			}
		}
	});
</script>


<?php require APPROOT . '/views/includes/footer.php'; ?>