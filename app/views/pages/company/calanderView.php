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
        'color' => '#054a91'
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
      <input type="date" name="start_date" id="start-date-input">
    </div>

    <div>
      <label for="sche-period">End Date</label>&nbsp;
      <input type="date" name="end_date" id="end-date-input">
    </div>

    <div>
      <label for="recurrence">Repeat</label>&nbsp;
      <select name="recurrence" id="recurrence">
        <option value="no_repeat">No Repeat</option>
        <option value="daily">Daily</option>
        <option value="weekly">Weekly</option>
        <option value="till-end-date">Till End Date</option>
      </select>
    </div>

    <div>
      <label for="interviewee_count">No. of interviewees you can interview within Same time slot</label>
      <input type="number" name="interviewee_count" id="interviewee_count">
    </div>

    <div>
      <label for="duration">Time slot Duration</label>&nbsp;
      <select name="duration" id="duration">
        <option value="15">15 minutes</option>
        <option value="30">30 minutes</option>
        <option value="60">1 Hour</option>
      </select>
    </div>

    <div>
      <button class="add-period" id="add-period">Add Time Period<span id="addIcon" class="material-symbols-outlined">library_add</span></button>
      <div id="time-slots" class="display-flex-col"></div>
    </div>

    <input type="hidden" name="advertisement_id" value="<?php echo $data['advertisment_id'] ?>">


    <button class="common-blue-btn" type="submit">Submit</button>
  </form>

  <div id="time-slot-popup" class="time-slot-popup display-flex-col">
    <div class="display-flex-row">
      <h3><span class="material-symbols-outlined">
          date_range
        </span></h3>
      <h3>Monday, 8 May</h3>
    </div>

    <div class="display-flex-row">
      <h3><span class="material-symbols-outlined">
          person
        </span></h3>
      <h3>Interviewee: </h3>
      <a href="#">Ruchira Bogahawatta</a>
    </div>
    <div class="display-flex-row">
      <h3><span class="material-symbols-outlined">
          work
        </span></h3>
      <h3>Position: </h3>
      <span class="slot-popup-position-tag">
        <p>Web Developer</p>
      </span>
    </div>
    <div class="display-flex-row">
      <h3><span class="material-symbols-outlined">
          schedule
        </span></h3>
      <h3>Time: </h3>
      <p>10:00AM - 10.30AM</p>
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
        eventSources: [{
          events: [
            <?php foreach ($events as $event) : ?> {
                title: '<?php echo $event['title']; ?>',
                date: '<?php echo $event['date']; ?>',



                color: '<?php echo $event['color']; ?>'
              },
            <?php endforeach; ?>
          ],
          color: 'black', // an option!
          textColor: 'white' // an option!
        }, ],
        eventClick: function(info) {
          popupTimeSlot(info);

          // change the border color just for fun
          info.el.style.borderColor = 'red';
        },
        dateClick: popupForm,
        contentHeight: 700,

      });

      calendar.render();

      form = document.getElementById('date-click-form');

      function popupForm(info) {
        let date = info.dateStr;
        if (form.style.display === 'none') {

          form.style.display = 'block';
        } else {

          form.style.display = 'none';
        }

      }

      let timeSlot = document.getElementById('time-slot-popup');

      //function to popup when dat eis clicked
      function popupTimeSlot(info) {
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
    <input type="time" step="900" min="09:00" max="18:00" class="period" name="end_time[${index}]" id="end_time_${index}">
  `;
        timeSlots.appendChild(div);
      });

    }

  );


  // }
</script>