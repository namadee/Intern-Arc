<?php
require_once('eventplanner_sidenav.php');
require_once('eventplanner_header.php');

$epID = $_SESSION['user_id'];
$sql = "SELECT * FROM ep_booking WHERE EP_id = $epID";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/eventPlannerMain.css">
    <link rel="stylesheet" href="../../css/calendarEP.css">
    <link href='../lib/fullcalendar/main.css' rel='stylesheet' />
    <link href='../../vendor/fullcalendar/main.css' rel='stylesheet' />
    <script src='../../vendor/fullcalendar/main.js'></script>
    <script>
        var rawEvents = <?php echo json_encode($result); ?>;
        var events = [];
        var color = '#2196F3';
        for (var i = 0; i < rawEvents.length; i++) {
            if(rawEvents[i].status == 'Accepted') {
                color = '#04AA6D';
            }
            var event = {
                id: rawEvents[i].booking_id,
                title: rawEvents[i].description,
                date: rawEvents[i].date,
                description: rawEvents[i].description,
                url: 'CustomerQuotations.php?qID=' + rawEvents[i].prepare_id,
                color: color,
            }
            events.push(event);
        }

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 600,
                editable: false,
                events: events,
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                },
                views: {
                    dayGridMonth: {
                        buttonText: "Month"
                    },
                    timeGridWeek: {
                        buttonText: "Week"
                    },
                    timeGridDay: {
                        buttonText: "Day"
                    },
                    listMonth: {
                        buttonText: "List"
                    }
                },
            });
            calendar.render();
        });
    </script>
</head>

<body>
    <div class="calendar-body">
        <div id='calendar'></div>
    </div>

</body>

</html>