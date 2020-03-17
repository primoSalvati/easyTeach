<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8' />


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