<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>

<?php require APPROOT . '/views/includes/navbar.php'; ?>
<section class="main-content">
  <div id='calendar'></div>
  
  <br>
  <form id="date-click-form" class="create-interview-form" action="<?php echo URLROOT . $data['formAction']; ?>" method="POST">
   <div class="topic-head">Software Engineer - Virtusa</div>
    
    <div><h3>Create Interview</h3></div>

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
    // const eventSources = [
    //   // your event source
    //   {
    //     ad_id: 'advertisement name',
    //     events: [], // initialize the events array as empty
    //     color: 'black', // an option!
    //     textColor: 'yellow' // an option!
    //   }
    // ]




    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
        

      },
      
      dateClick: popupForm,
      contentHeight: 600,
     
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
//       function setMinutesToClosest(input) {
//   let d = new Date();
//   d.setHours(input.value.split(':')[0], input.value.split(':')[1]);
//   let m = d.getMinutes();
//   if (m > 0 && m < 30) {
//     d.setMinutes(30);
//   } else if (m > 30 && m < 60) {
//     d.setMinutes(0);
//     d.setHours(d.getHours()+1);
//   }
//   input.value = d.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
// }



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