<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>

<?php require APPROOT . '/views/includes/navbar.php'; ?>
<section class="main-content">
	<?php flashMessage('Interview_msg'); ?>
	<div id='calendar'></div>
	<?php

	$events = array();

	foreach ($data['interviewSlots'] as $interviewslots) : {

			//add $inteviewsslots->start_time $interveiwslots->end_time $interviewslots->date to events array
			$events[] = array(
				'title' => $interviewslots->position,
				'date' => $interviewslots->slot_date,
				'mystarttime' => $interviewslots->start_time,
				'myendtime' => $interviewslots->end_time,
				'slotId' => $interviewslots->slot_id,
				// 'companyName' => $interviewslots->company_name,

			);
		}
	?><?php endforeach ?>


	<br>

	<div id="time-slot-popup" class="time-slot-popup display-flex-col">
		<div class="display-flex-row">
			<h3><span class="material-symbols-outlined">
					date_range
				</span></h3>
			<h3 id="day"></h3>
		</div>

		<div class="display-flex-row">
			<h3><span class="material-symbols-outlined">
					person
				</span></h3>
			<h3>Company: </h3>
			<a href="#">Virtusa</a>
		</div>
		<div class="display-flex-row">
			<h3><span class="material-symbols-outlined">
					work
				</span></h3>
			<h3>Position: </h3>
			<span class="slot-popup-position-tag">
				<p id="position"></p>
			</span>
		</div>
		<div class="display-flex-row">
			<h3><span class="material-symbols-outlined">
					schedule
				</span></h3>
			<h3>Time: </h3>
			<div class="display-flex-row">
				<p id="my-start-time">10:00AM </p>-<p id="my-end-time"> 10.30AM</p>
			</div>
		</div>
		<div class="display-flex-row">

			<a id="book-btn" class="common-blue-btn" href="">Book</a>
			<a class="common-blue-btn">Cancel</a>
		</div>


	</div>





</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>

<script>
	document.addEventListener('DOMContentLoaded', function() {

			let calendarEl = document.getElementById('calendar');

			let calendar = new FullCalendar.Calendar(calendarEl, {
				initialView: 'dayGridMonth',
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay'
				},
				//add $events_by_advertisement as event sources
				//set events array as jspn
				events: <?php echo json_encode($events); ?>,


				eventClick: function(info) {
					popupTimeSlot(info);
				},

				contentHeight: 700,

			});

			calendar.render();


			let timeSlot = document.getElementById('time-slot-popup');

			//function to popup when dat eis clicked
			function popupTimeSlot(info) {
				//console log info.event.title
				console.log(info.event.title);
				document.getElementById("position").innerHTML = info.event.title;


				//console log info.event.extendedProps.companyName
				console.log(info.event.extendedProps.myendtime);

				//console log date from info 
				console.log(info.event.start);
				const formattedDate = info.event.start.toLocaleDateString("en-US", {
					weekday: "short",
					month: "short",
					day: "numeric"
				});
				document.getElementById("day").innerHTML = formattedDate;

				//console log info.event.extendedProps.mystarttime
				console.log(info.event.extendedProps.mystarttime);
				const formattedStratTime = new Date("2000-01-01T" + info.event.extendedProps.mystarttime + "Z").toLocaleTimeString("en-US", {
					hour: "numeric",
					minute: "numeric",
					hour12: true
				});
				document.getElementById("my-start-time").innerHTML = formattedStratTime;


				console.log(info.event.extendedProps.myendtime);
				const formattedEndTime = new Date("2000-01-01T" + info.event.extendedProps.myendtime + "Z").toLocaleTimeString("en-US", {
					hour: "numeric",
					minute: "numeric",
					hour12: true
				});
				document.getElementById("my-end-time").innerHTML = formattedEndTime;

				console.log(info.event.extendedProps.slotId);

				if (timeSlot.style.display === 'none') {
					timeSlot.style.display = 'block';
				} else {
					timeSlot.style.display = 'none';
				}


				let url = info.event.extendedProps.slotId;
				const bookBtn = document.getElementById('book-btn');
				bookBtn.removeEventListener('click', confirmBooking);
				const confirmed = false;

				function confirmBooking(event) {


					const confirmed = window.confirm('Are you sure you want to book?');
					console.log(confirmed);
					bookBtn.removeEventListener('click', confirmBooking);

					if (confirmed) {
						bookBtn.href = "<?php echo URLROOT; ?>students/book-interview-slot/" + url;
						bookBtn.removeEventListener('click', confirmBooking);
					} else {
						event.preventDefault();
					}
				}
				bookBtn.removeEventListener('click', confirmBooking);
				bookBtn.addEventListener('click', confirmBooking);



			}


		}

	);



	// }
</script>