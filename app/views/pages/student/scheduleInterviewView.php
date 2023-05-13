<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>

<?php require APPROOT . '/views/includes/navbar.php'; ?>
<section class="main-content">
	<?php flashMessage('Interview_msg'); ?>
	<div id='calendar'></div>
	<?php

	$events = array();
	$color = '';

	foreach ($data['interviewSlots'] as $interviewslots) : {
			$color =  ($interviewslots->reserved == 1) ? '#dddddd' : '#054a91';

			//add $inteviewsslots->start_time $interveiwslots->end_time $interviewslots->date to events array
			$events[] = array(
				'title' => $interviewslots->position,
				'date' => $interviewslots->slot_date,
				'mystarttime' => $interviewslots->start_time,
				'myendtime' => $interviewslots->end_time,
				'slotId' => $interviewslots->slot_id,
				'color' => $color,
				'companyName' => $interviewslots->company_name,
				'adId' => $interviewslots->advertisement_id
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
			<a id="company-name"></a>
		</div>
		<div class="display-flex-row">
			<h3><span class="material-symbols-outlined">
					work
				</span></h3>
			<h3>Position: </h3>
			<span class="slot-popup-position-tag">
				<a id="position" href="#"></a>
			</span>
		</div>
		<div class="display-flex-row">
			<h3><span class="material-symbols-outlined">
					schedule
				</span></h3>
			<h3>Time: </h3>
			<div class="display-flex-row">
				<p id="my-start-time"> </p>-<p id="my-end-time"></p>
			</div>
		</div>
		<div class="display-flex-row">

			<a id="book-btn" class="common-blue-btn" href="">Reserve Slot</a>
			<a id="closePopup" class="common-blue-btn">Cancel</a>
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
					right: 'dayGridMonth'
				},
				//add $events_by_advertisement as event sources
				//set events array as jspn
				events: <?php echo json_encode($events); ?>,


				eventClick: function(info) {

					(info.event.backgroundColor == '#dddddd' ? '' : popupTimeSlot(info));
				},

				contentHeight: 700,

			});

			calendar.render();


			let timeSlot = document.getElementById('time-slot-popup');
			let slotid = '';
			let advertisementid = '';
			//function to popup when dat eis clicked
			function popupTimeSlot(info) {
				//access color value of event 
				console.log(info.event.color);

				//console log info.event.title

				document.getElementById("position").innerHTML = info.event.title;

				//add advertisement link  URLROOT .advertisements/view-advertisement/ . advertisement_id to position a tag 
				document.getElementById("position").href = "<?php echo URLROOT; ?>advertisements/view-advertisement/" + info.event.extendedProps.adId;

				console.log(info.event.extendedProps.companyName);
				document.getElementById("company-name").innerHTML = info.event.extendedProps.companyName;


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
					hour12: true,
					timeZone: "UTC" // Set the timezone to UTC
				});
				document.getElementById("my-start-time").innerHTML = formattedStratTime;


				console.log(info.event.extendedProps.myendtime);
				const formattedEndTime = new Date("2000-01-01T" + info.event.extendedProps.myendtime + "Z").toLocaleTimeString("en-US", {
					hour: "numeric",
					minute: "numeric",
					hour12: true,
					timeZone: "UTC" // Set the timezone to UTC
				});
				document.getElementById("my-end-time").innerHTML = formattedEndTime;

				console.log(info.event.extendedProps.slotId);

				//close popup on clicking cancel button
				const closePopup = document.getElementById('closePopup');
				closePopup.addEventListener('click', function() {
					timeSlot.style.display = 'none';
				});


				if (timeSlot.style.display === 'none') {
					timeSlot.style.display = 'block';
				} else {
					timeSlot.style.display = 'none';
				}


				slotid = info.event.extendedProps.slotId;
				advertisementid = info.event.extendedProps.adId;

			}
			const bookBtn = document.getElementById('book-btn');

			if (bookBtn) {
				bookBtn.addEventListener('click', confirmBooking);
			}

			function confirmBooking(event) {
				console.log('clicked');
				if (confirm('Are you sure you want to Reserve this slot?')) {
					bookBtn.href = "<?php echo URLROOT; ?>students/book-interview-slot/" + slotid + "/" + advertisementid;
				} else {
					event.preventDefault();
				}
			}


		}

	);



	// }
</script>