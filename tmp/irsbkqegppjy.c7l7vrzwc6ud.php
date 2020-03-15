<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />



<link href='/assets/demo-to-codepen.css' rel='stylesheet' />


  <style>

/*     #calendar {
      max-width: 900px;
      margin: 40px auto;
    } */

  </style>


<link href='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css' rel='stylesheet' />


  

  <link href='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css' rel='stylesheet' />

  <link href='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.css' rel='stylesheet' />


<script src='/assets/demo-to-codepen.js'></script>

<script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js'></script>




  <script src='https://unpkg.com/@fullcalendar/interaction@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js'></script>



  
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

var date = new Date().toISOString().split('T')[0];


    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
      defaultView: 'dayGridMonth',
      defaultDate: date,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      dateClick: function(info) {

        window.location.href = '/lessons/seeAllStudents?date=' + info.dateStr;
      },

      events: 
          <?= ($this->raw($events))."
" ?>
        /*[{
          title: 'All Day Event',
          start: '2020-02-01'
        },
        {
          title: 'Long Event',
          start: '2020-02-07',
          end: '2020-02-10'
        },
        {
          groupId: '999',
          title: 'Repeating Event',
          start: '2020-02-09T16:00:00'
        },
        {
          groupId: '999',
          title: 'Repeating Event',
          start: '2020-02-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2020-02-11',
          end: '2020-02-13'
        },
        {
          title: 'Meeting',
          start: '2020-02-12T10:30:00',
          end: '2020-02-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2020-02-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2020-02-12T14:30:00'
        },
        {
          title: 'Birthday Party',
          start: '2020-02-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2020-02-28'
        }]*/
      
    });

    calendar.render();
  });

</script>

</head>
<body>
  <div id='calendar'></div>
</body>

</html>

<!-- TODO: separare i concerns del calendario! -->
