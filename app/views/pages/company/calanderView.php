<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>

<?php require APPROOT . '/views/includes/navbar.php'; ?>
<section class="main-content">
  <div id='calendar'></div>
  <?php

  $events = array();

  foreach ($data['timeslots'] as $interviewslots) : {

      //add $inteviewsslots->start_time $interveiwslots->end_time $interviewslots->date to events array
      $events[] = array(
        'title' => $interviewslots->position,
        'date' => $interviewslots->slot_date,
        'startTime' => $interviewslots->start_time,
        'endTime' => $interviewslots->end_time,
        'intervieweeName' => $interviewslots->profile_name,
        'stdId' => $interviewslots->student_id,
        'reserved' => $interviewslots->reserved,
        'userID' => $interviewslots->user_id
      );


      // Do something with the start time, end time, and date
      // For example, you can print them out like this:

    }
  ?><?php endforeach ?>

  <?php
  // Initialize an empty associative array to store events for each advertisement
  $events_by_advertisement = array();

  // Iterate over the interview slots and group them by advertisement id
  foreach ($data['timeslots'] as $slot) : {
      $advertisement_id = $slot->advertisement_id;

      // If this is the first event for this advertisement, create a new array
      if (!isset($events_by_advertisement[$advertisement_id])) {
        $events_by_advertisement[$advertisement_id] = array();
      }

      // Add the event to the array for this advertisement
      $events_by_advertisement[$advertisement_id][] = array(
        'id' => $slot->advertisement_id,
        'title' => $slot->position,
        'date' => $slot->slot_date,
        'slotStart' => $slot->start_time,
        'slotEnd' => $slot->end_time,
        'intervieweeName' => $slot->profile_name,
        'stdId' => $slot->student_id,
        'reserved' => $slot->reserved,
        'userID' => $slot->user_id,
        'color' => ($slot->reserved == 1) ? '#054a91' : '#bbd9f7'
      );
    }


  ?><?php endforeach; ?>

  <!-- I have no idea how this works -->
  <?php foreach ($events_by_advertisement as $advertisement_id => $events) : ?>
  <?php endforeach; ?>



  <br>
  <form id="date-click-form" class="create-interview-form" action="<?php echo URLROOT . $data['formAction']; ?>" method="POST">
    <div class="topic-head">Software Engineer - Virtusa</div>

    <div>
      <h3>Create Interview</h3>
    </div>

    <div>
      <label for="sche-period">Start Date</label>
      <input class="common-input" type="date" name="start_date" value="" id="start-date-input">
    </div>

    <div>
      <label for="sche-period">End Date</label>&nbsp;
      <input class="common-input" type="date" name="end_date" id="end-date-input">
    </div>

    <div>
      <label for="recurrence">Repeat</label>&nbsp;
      <select class="common-input" name="recurrence" id="recurrence">
        <option value="no_repeat">No Repeat</option>
        <option value="daily">Daily</option>
        <option value="weekly">Weekly</option>
        <option value="till-end-date">Till End Date</option>
      </select>
    </div>

    <div>
      <label for="interviewee_count">No. of interviewees you can interview within Same time slot</label>
      <input class="common-input" type="number" name="interviewee_count" id="interviewee_count">
    </div>

    <div>
      <label for="duration">Time slot Duration</label>&nbsp;
      <select class="common-input" name="duration" id="duration">
        <option value="15">15 minutes</option>
        <option value="30">30 minutes</option>
        <option value="60">1 Hour</option>
      </select>
    </div>

    <div>
      <button style="cursor: pointer;" class="add-period" id="add-period">Add Time Period<span id="addIcon" class="material-symbols-outlined">library_add</span></button>
      <div id="time-slots" class="display-flex-col"></div>
    </div>

    <input type="hidden" name="advertisement_id" value="<?php echo $data['advertisment_id'] ?>">
    <input type="hidden" name="schedule_status" value="<?php echo 1 ?>">


    <button class="common-blue-btn" type="submit">Submit</button>
  </form>

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
      <h3>Interviewee: </h3>
      <a id="std-name" href="#"></a>
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
      <p id="my-start-time"> </p>-<p id="my-end-time"></p>
    </div>

  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      let date;

      let calendarEl = document.getElementById('calendar');

      let calendar = new FullCalendar.Calendar(calendarEl, {
        validRange: {
          start: new Date().toISOString().split('T')[0]
        },
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth'
        },
        //add $events_by_advertisement as event sources
        eventSources: [{
          events: [
            <?php foreach ($events as $event) : ?> {
                title: '<?php echo $event['title']; ?>',
                date: '<?php echo $event['date']; ?>',
                color: '<?php echo $event['color']; ?>',
                myStartTime: '<?php echo $event['slotStart'] ?>',
                myEndTime: '<?php echo $event['slotEnd'] ?>',
                intervieweeName: '<?php echo $event['intervieweeName'] ?>',
                stdId: '<?php echo $event['stdId'] ?>',
                reserved: '<?php echo $event['reserved'] ?>',
                userID: '<?php echo $event['userID'] ?>',

              },
            <?php endforeach; ?>
          ],


        }, ],
        eventClick: function(info) {
          popupTimeSlot(info);

        },
        dateClick: popupForm,
        contentHeight: 700,

      });

      calendar.render();

      form = document.getElementById('date-click-form');

      function popupForm(info) {
        date = info.dateStr;
        console.log(date);
        if (form.style.display === 'none') {

          form.style.display = 'block';
        } else {

          form.style.display = 'none';
        }

      }
      const startDateInput = document.getElementById('start-date-input');
      const endDateInput = document.getElementById('end-date-input');
      const today = new Date().toISOString().split('T')[0];
      startDateInput.min = today;

      startDateInput.addEventListener('input', () => {
        endDateInput.min = startDateInput.value;
      });


      let timeSlot = document.getElementById('time-slot-popup');

      //function to popup when dat eis clicked
      function popupTimeSlot(info) {
        console.log(info.event);
        document.getElementById("position").innerHTML = info.event.title;

        document.getElementById("day").innerHTML = info.event.start.toLocaleDateString("en-US", {
          weekday: "short",
          month: "short",
          day: "numeric"
        });

        //console log reserved from info
        console.log(info.event.extendedProps.reserved);
        if (info.event.extendedProps.reserved == 0) {
          document.getElementById("std-name").href = "javascript:void(0)";

        } else {
          document.getElementById("std-name").href = "<?php echo URLROOT; ?>profiles/view-student-profile/" + info.event.extendedProps.userID;
        }

        document.getElementById("std-name").innerHTML = (info.event.backgroundColor == '#bbd9f7' ? "Not Reserved" : info.event.extendedProps.intervieweeName);



        const formattedStartTime = new Date("2000-01-01T" + info.event.extendedProps.myStartTime + "Z").toLocaleTimeString("en-US", {
          hour: "numeric",
          minute: "numeric",
          hour12: true,
          timeZone: "UTC" // Set the timezone to UTC
        });
        document.getElementById("my-start-time").innerHTML = formattedStartTime;

        const formattedEndTime = new Date("2000-01-01T" + info.event.extendedProps.myEndTime + "Z").toLocaleTimeString("en-US", {
          hour: "numeric",
          minute: "numeric",
          hour12: true,
          timeZone: "UTC" // Set the timezone to UTC
        });
        document.getElementById("my-end-time").innerHTML = formattedEndTime;


        //console log all properties of the event
        console.log(info.event.extendedProps);




        if (timeSlot.style.display === 'none') {
          timeSlot.style.display = 'block';
        } else {
          timeSlot.style.display = 'none';
        }
      }


      const addPeriodBtn = document.getElementById('add-period');
      const timeSlots = document.getElementById('time-slots');



      //insert each start time and end time from each input generated into a data structure
      addPeriodBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const div = document.createElement('div');
        div.classList.add('display-flex-row', 'periods-box');


        const index = timeSlots.children.length;
        div.innerHTML = `
    <input type="time" step="900" min="09:00" max="18:00" class="period" name="start_time[${index}]" id="start_time_${index}">
    <input type="time" step="900" min="09:00" max="18:00" class="period" name="end_time[${index}]" id="end_time_${index}" >
  `;
        timeSlots.appendChild(div);
      });

    }

  );


  // }
</script>