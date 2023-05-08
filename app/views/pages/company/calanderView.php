<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    dateClick: function(info) {
      var date = info.dateStr;
      var modal = document.createElement('div');
      modal.style.position = 'fixed';
      modal.style.top = '0';
      modal.style.right = '0';
      modal.style.bottom = '0';
      modal.style.left = '0';
      modal.style.background = 'rgba(0, 0, 0, 0.5)';
      modal.style.display = 'flex';
      modal.style.justifyContent = 'center';
      modal.style.alignItems = 'center';
      modal.addEventListener('click', function(event) {
        if (event.target === modal) {
          modal.remove();
        }
      });
      
      var formContent = document.getElementById('form-content');
      var form = formContent.cloneNode(true);
      form.style.display = 'block';
      form.action = '/your-action-url'; // Replace with your form's action URL
      form.method = 'POST'; // Replace with your form's HTTP method
      var input = form.querySelector('input[name="date"]');
      input.value = date;
      
      modal.appendChild(form);
      document.body.appendChild(modal);
    }
  });
  
  calendar.render();
});




    </script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>
  <section class="main-content">
    <div id='calendar'></div>
    <div id="form-content" style="display:none;">
  <form>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    
    <label for="message">Message:</label>
    <textarea name="message" id="message" required></textarea>
    
    <input type="hidden" name="date" id="date">
    
    <button type="submit">Submit</button>
  </form>
</div>

  </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>