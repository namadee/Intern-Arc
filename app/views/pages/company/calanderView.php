<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>

<?php require APPROOT . '/views/includes/navbar.php'; ?>
<section class="main-content">
  <div id='calendar'></div>
  <h3>Create Interviews</h3>
  <br>
  <form id="date-click-form" class="create-interview-form" action="">
    <h3>Create Interview</h3>
    <div>
      <label for="Interviewee_count">Interviewee_count:</label>
      <input type="number" id="Interviewee_count">
    </div>
    <div>
      <label for="sche-period">Start Date</label>
      <input type="date" name="sche-start" id="start-date-input">
    </div>
    <div>
      <label for="duration">Interview Duration</label>&nbsp;
      <select name="durations" id="durations">
        <option value="15">15 minutes</option>
        <option value="30">30 minutes</option>
        <option value="1">1 Hour</option>
      </select>
    </div>
    <div>
      <label for="duration">Repeat</label>&nbsp;
      <select name="durations" id="repeat" >
        <option value="15">Daily</option>
        <option value="30">Weekly</option>
        <option id="select1" value="till-end-date">Till End Date</option>
      </select>
    </div>
    <div id="show-date" style="display: none;">
      <label for="sche-period" >End Date</label>&nbsp;
      <input type="date" name="sche-end" id="end-date-input">
    </div>
    <div>
      <label for="start-time-input">Start Time</label>
      <input type="time" id="start-time-input" name="start-time-input" min="09:00" max="18:00" required>
    </div>
    <div>
      <label for="start-time-input">End Time</label>
      <input type="time" id="end-time-input" name="end-time-input" min="09:00" max="18:00" required>
    </div>
    <div>
      <label for="description">Description:</label>
      <textarea name="description" id="description"></textarea>
    </div>
    <button class="common-blue-btn" type="submit">Submit</button>
  </form>
  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>

<script>
   
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    const eventSources = [
      // your event source
      {
        ad_id: 'advertisement name',
        events: [], // initialize the events array as empty
        color: 'black', // an option!
        textColor: 'yellow' // an option!
      }
    ]

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      dateClick: popupForm,
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
        // get the form input values
      var startDate = document.getElementById('start-date-input').value;
      var endDate = document.getElementById('end-date-input').value;
      var startTime = document.getElementById('start-time-input').value;
      var endTime = document.getElementById('end-time-input').value;
      var interviewCount = document.getElementById('Interviewee_count').value;
      var duration = document.getElementById('durations').value;
      var description = document.getElementById('description').value;

      // create the event object
      var event = {
        title: interviewCount + ' Interview(s)',
        start: startDate + 'T' + startTime,
        end: endDate + 'T' + endTime,
        category: 'category1',
        description: description
      };
      console.log(event);

      // add the event to the events array
      eventSources[0].events.push(event);

      // add the event source to the calendar
      calendar.addEventSource(eventSources);
      console.log(date);
      inputtag =document.getElementById("show-date");
  dropdown =document.getElementById("repeat");
  
  
  dropdown.addEventListener("change", function() {
    console.log(dropdown);
  console.log(inputtag);
  console.log("hello");
    
    
    if (dropdown.value == "till-end-date") {
      inputtag.style.display = "block";
    console.log("selected");
    console.log(dropdown.value)

    } else {
      inputtag.style.display = "none";
    }

    });
    }
    },
    
   
  );
  

  // function showinp(){
  //   console.log("selected");
    
  //   if (dropdown.value === "till-end-date") {
  //   element.style.display = "block";
  //   } else {
  //   element.style.display = "none";
  //   }

    
  // }
</script>