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
        'start' => $interviewslots->slotStartDate,
        'end' => $interviewslots->slotEndDate,
        'date' => $interviewslots->slot_date
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
        'start' => $slot->slotStartDate,
        'end' => $slot->slotEndDate,
        'date' => $slot->slot_date,
        'color' => '#054a91'
      );
    }

    // Now $events_by_advertisement is an associative array where the keys are advertisement ids
    // and the values are arrays of events for each advertisement


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

    <!-- <div>
      <label for="description">Description:</label>
      <textarea name="description" id="description"></textarea>
    </div> -->
    <button class="common-blue-btn" type="submit">Submit</button>
  </form>
  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
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
                start: '<?php echo $event['start']; ?>',
                end: '<?php echo $event['end']; ?>',


                color: '<?php echo $event['color']; ?>'
              },
            <?php endforeach; ?>
          ],
          color: 'black', // an option!
          textColor: 'white' // an option!
        },



      ],


      dateClick: popupForm,
      contentHeight: 700,

    });

    calendar.render();

    form = document.getElementById('date-click-form');

    function popupForm(info) {
      var date = info.dateStr;
      if (form.style.display === 'none') {

        form.style.display = 'block';
      } else {

        form.style.display = 'none';
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
  });


  // }
</script>