document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        initialView : 'dayGridMonth',
        themeSystem: 'bootstrap',
        headerToolbar: {
          left: 'title prev,next',
          center: null,
          right: 'today dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        height: 800,
        contentHeight: 780,
        aspectRatio: 3,
        editable: true,
        droppable: true,
        views: {
          dayGridMonth: {
            dayMaxEventRows: 2
          }
        },
    });
    calendar.render();
});