<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8' />



  <link href='/assets/demo-to-codepen.css' rel='stylesheet' />

  <link href='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css' rel='stylesheet' />

  <link href='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css' rel='stylesheet' />

  <link href='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.css' rel='stylesheet' />


  <script src='/assets/demo-to-codepen.js'></script>

  <script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js'></script>




  <script src='https://unpkg.com/@fullcalendar/interaction@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js'></script>




  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');

      var date = new Date().toISOString().split('T')[0];


      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid'],
        defaultView: 'dayGridMonth',
        defaultDate: date,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        dateClick: function (info) {

          window.location.href = '/lessons/seeAllStudents?date=' + info.dateStr;
        },

        events: <?= ($this->raw($events))."
" ?>

      });

      calendar.render();
    });
  </script>

</head>

<body>
  <div id='calendar'></div>
</body>

</html>