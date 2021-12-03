var url_atual = window.location.href;
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    eventDisplay: 'block',
    eventSources: [
      {
        url: url_atual+'/getCalendario',
        method: 'GET',
        success: function(data) {
          return data.eventArray;
        },
        failure: function(data){
          console.log(data);
        },
      }
    ],
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
      endTime: '18:00' // 6pm
    },
    businessHours: {
      daysOfWeek: [6], // sabado
      startTime: '08:00', // 10am
      endTime: '12:00' // 4pm
    },

    eventClick:  function(event, jsEvent, view) {
      $('#details').modal('show');

    $('#details').find('#nomecliente').text(event.event.id)
  },
  

    eventLimit: true, // for all non-TimeGrid views
  views: {
    dayGridMonth: {
      eventLimit: 6, // adjust to 6 only for timeGridWeek/timeGridDay
      dayMaxEventRows: 3
    }
  },
    
  
});
    calendar.render();
});


console.log(url_atual+'/getCalendario')
