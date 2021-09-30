
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: "http://localhost:8000/admin/getCalendario",
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
    businessHours: {
      daysOfWeek: [ 1, 2, 3, 4, 5], // Monday, Tuesday, Wednesday
      startTime: '08:00', // 8am
      endTime: '17:30' // 6pm
    },
    businessHours: {
      daysOfWeek: [6], // sabado
      startTime: '08:00', // 10am
      endTime: '12:00' // 4pm
    },

    eventLimit: true, // for all non-TimeGrid views
  views: {
    dayGridMonth: {
      eventLimit: 3, // adjust to 6 only for timeGridWeek/timeGridDay
      dayMaxEventRows: 3
    }
  },
    
  
});
    calendar.render();
});
