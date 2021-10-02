
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: "http://192.168.100.163:8000/admin/getCalendario",
    lang: 'pt-br',
    locale: 'pt-br',
    themeSystem: 'bootstrap',
    selectable: true,
    dayMaxEventRows: true,
    views:{
      resourceTimelineWeek: {
        slotDuration: { days: 1 }
      }
  },

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

    eventClick:  function(event, jsEvent, view) {
      $('#details').modal('show');

    $('#details').find('.modal-title').text(event.event.title)
    $('#details').find('.modal-data').text(event.event.start)
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
