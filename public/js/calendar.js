
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: "http://localhost:8000/admin/OS/getData",
    lang: 'pt-br',
    locale: 'pt-br',
    themeSystem: 'bootstrap',
    selectable: true,
    dayMaxEventRows: true,

    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'today dayGridMonth,dayGridWeek,timeGridDay'
    },
    eventLimit: true, // for all non-TimeGrid views
  views: {
    dayGridMonth: {
      eventLimit: 4, // adjust to 6 only for timeGridWeek/timeGridDay
      dayMaxEventRows: 4
    }
  },
    
  
});
    calendar.render();
});
